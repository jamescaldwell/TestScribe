<?php

namespace Box\TestScribe\PHPDoc;

use Box\TestScribe;

/**
 * Class PHPDocParser
 *
 * parses PHPDoc type string and returns a PHPDocType instance. Uses the following grammar:
 *
 * TOP_LEVEL_TYPE ::= VARIADIC | TYPE
 * TYPE ::= COMPOSITE | NON_COMPOSITE
 * COMPOSITE ::= NON_COMPOSITE '|' TYPE
 * NON_COMPOSITE ::= ARRAY | NON_ARRAY
 * ARRAY ::= NON_ARRAY '[]'+
 * NON_ARRAY ::= OPTIONAL | NON_OPTIONAL
 * OPTIONAL ::= NON_OPTIONAL '?'
 * NON_OPTIONAL ::= '(' TYPE ')' | PRIMITIVE | CLASS
 * PRIMITIVE ::= 'int' | 'integer' | 'void' | ...
 * VARIADIC ::= '*' TYPE
 * CLASS ::= [a-zA-Z\_0-9]+
 *
 */
class PHPDocParser
{
    private $string_representation;
    /** @var PHPDocLexer */
    private $lexer;

    /**
     * @param string $string_representation
     */
    public function __construct($string_representation)
    {
        $this->string_representation = $string_representation;
        $this->lexer = new PHPDocLexer($string_representation);
    }

    /**
     * parses type string representation into PHPDocType instance.
     *
     * see TOP_LEVEL_TYPE grammar rule
     *
     * @return PHPDocType
     */
    public function parse()
    {
        TestScribe\Assert::with('Box\TestScribe\PHPDoc\PHPDocTypeException')->is_true($this->lexer->has_more(), "The PHPDocType '$this->string_representation' is invalid or is not supported");

        $type = $this->parse_variadic();
        if ($type !== null) {
            $type->setRepresentation($this->string_representation);
        } else {
            $type = $this->parse_type();
        }

        TestScribe\Assert::with('Box\TestScribe\PHPDoc\PHPDocTypeException')->is_false($this->lexer->has_more(),
                                                        "The PHPDocType '$this->string_representation' is invalid or is not supported: unexpected trailing input '{$this->lexer->get_remaining_input()}'");
        TestScribe\Assert::with('Box\TestScribe\PHPDoc\PHPDocTypeException')->is_not_null($type, "The PHPDocType '$this->string_representation' is invalid or is not supported");
        return $type;
    }

    /**
     * parses variadic rule
     *
     * @return PHPDocVariadicType|null
     */
    private function parse_variadic()
    {
        if (!$this->lexer->has_more()) {
            return null;
        }

        $tok = $this->lexer->next_token();
        if ($tok !== "*") {
            $this->lexer->pushback();
            return null;
        }
        $start_index = $this->lexer->get_token_index();
        $type = $this->parse_type();
        $string_rep = $this->lexer->get_tokens_from_index_to_current_index($start_index);

        TestScribe\Assert::with('Box\TestScribe\PHPDoc\PHPDocTypeException')->is_not_null($type, "The PHPDocType '$string_rep' is invalid or is not supported");
        $res_type = new PHPDocVariadicType($type);
        $res_type->setRepresentation($string_rep);
        return $res_type;
    }

    /**
     * parses TYPE rule
     *
     * @return null|PHPDocType
     */
    private function parse_type()
    {
        if (!$this->lexer->has_more()) {
            return null;
        }

        $type = $this->parse_composite();
        if ($type !== null) {
            return $type;
        }

        return $this->parse_non_composite();
    }

    /**
     * parses COMPOSITE rule
     *
     * @return null|PHPDocType
     */
    private function parse_composite()
    {
        $start_index = $this->lexer->get_token_index();

        $first_type = $this->parse_non_composite();
        if ($first_type === null) {
            return null;
        }

        if (!$this->lexer->has_more()) {
            return $first_type;
        }

        $tok = $this->lexer->next_token();

        if ($tok !== "|") {
            $this->lexer->pushback();
            return $first_type;
        }

        $second_type = $this->parse_type();

        $string_rep = $this->lexer->get_tokens_from_index_to_current_index($start_index);

        TestScribe\Assert::with('Box\TestScribe\PHPDoc\PHPDocTypeException')->is_not_null($second_type, "The PHPDocType '$string_rep' is invalid or is not supported");

        $res_type = new PHPDocCompositeType([$first_type, $second_type]);
        $res_type->setRepresentation($string_rep);
        return $res_type;
    }

    /**
     * This parses NON_COMPOSITE rule including array, non_array, optional and non_optional rules, i.e.
     * it parses arrays and optionals and delegates to PARSE_NON_COMPOSITE for underlying types
     * @return null|PHPDocType
     */
    private function parse_non_composite()
    {
        if (!$this->lexer->has_more()) {
            return null;
        }

        // parse non-array type first

        $start_index = $this->lexer->get_token_index();
        $type = $this->parse_non_optional();
        if ($type === null) {
            return null;
        }

        // then try to consume as much [][]'s as we can (possibly 0), which can also be interleaved with '?' for optionals

        $is_optional = false;
        while ($this->lexer->has_more()) {
            $tok = $this->lexer->next_token();

            // is it an optional?
            if ($tok === "?") {
                $string_rep = $this->lexer->get_tokens_from_index_to_current_index($start_index);
                TestScribe\Assert::with('Box\TestScribe\PHPDoc\PHPDocTypeException')->is_false($is_optional, "The PHPDocType '$string_rep' is invalid or is not supported: '?' followed by another '?'");
                $is_optional = true;
                $type = new PHPDocOptionalType($type);
                $type->setRepresentation($string_rep);
                continue;
            }

            // is it an array? if not: break out of the loop
            if ($tok !== "[") {
                $this->lexer->pushback();
                break;
            }
            $tok = $this->lexer->next_token();
            $string_rep = $this->lexer->get_tokens_from_index_to_current_index($start_index);
            TestScribe\Assert::with('Box\TestScribe\PHPDoc\PHPDocTypeException')->are_equal("]", $tok, "The PHPDocType '$string_rep' is invalid or is not supported");

            $type = new PHPDocArrayOfType($type);
            $type->setRepresentation($string_rep);
            $is_optional = false;
        }

        return $type;
    }

    /**
     * parses NON_OPTIONAL rule
     *
     * @return null|PHPDocType
     */
    private function parse_non_optional()
    {
        if (!$this->lexer->has_more()) {
            return null;
        }

        $start_index = $this->lexer->get_token_index();

        $tok = $this->lexer->next_token();
        if ($tok === "(") {
            $type = $this->parse_type();
            $string_rep = $this->lexer->get_tokens_from_index_to_current_index($start_index);
            TestScribe\Assert::with('Box\TestScribe\PHPDoc\PHPDocTypeException')->is_not_null($type, "The PHPDocType '$string_rep' is invalid or is not supported");
            $tok = $this->lexer->next_token();
            $string_rep = $this->lexer->get_tokens_from_index_to_current_index($start_index);
            TestScribe\Assert::with('Box\TestScribe\PHPDoc\PHPDocTypeException')->are_equal(")", $tok, "The PHPDocType '$string_rep' is invalid or is not supported");
            return $type;
        } else {
            $this->lexer->pushback();
        }

        $type = $this->parse_primitive();
        if ($type !== null) {
            return $type;
        }

        $type = $this->parse_class();
        return $type;
    }

    /**
     * parses PRIMITIVE rule
     *
     * @return null|PHPDocType
     */
    private function parse_primitive()
    {
        $start_index = $this->lexer->get_token_index();
        $type = $this->parse_primitive0();
        if ($type !== null) {
            $string_rep = $this->lexer->get_tokens_from_index_to_current_index($start_index);
            $type->setRepresentation($string_rep);
        }
        return $type;
    }

    /**
     * parses PRIMITIVE rule but doesn't set correct string representation on the result
     *
     * @return null|PHPDocType
     */
    private function parse_primitive0()
    {
        if (!$this->lexer->has_more()) {
            return null;
        }

        $tok = $this->lexer->next_token();
        switch ($tok) {
            case 'int':
            case 'integer':
                return new PHPDocIntegerType();
                break;
            case 'uint':
            case 'unsigned_integer':
                return new PHPDocUnsignedIntegerType();
                break;
            case 'float':
            case 'double':
            case 'real':
                return new PHPDocFloatType();
                break;
            case 'numeric':
                return new PHPDocNumericType();
                break;
            case 'array':
                return new PHPDocArrayOfType(new PHPDocOptionalType(new PHPDocMixedType()));
                break;
            case 'null':
                return new PHPDocNullType();
                break;
            case 'void':
                return new PHPDocVoidType();
                break;
            case 'bool':
            case 'boolean':
                return new PHPDocBooleanType();
                break;
            case 'callable':
                return new PHPDocCallableType();
                break;
            case 'mixed':
                return new PHPDocMixedType();
                break;
            case 'object':
                return new PHPDocObjectType();
                break;
            case 'resource':
                return new PHPDocResourceType();
                break;
            case 'string':
            case 'varchar':
                return new PHPDocStringType();
                break;
            default:
                $this->lexer->pushback();
                return null;
        }
    }

    /**
     * parses CLASS rule
     *
     * @return null|PHPDocClassType
     */
    private function parse_class()
    {
        if (!$this->lexer->has_more()) {
            return null;
        }

        $start_index = $this->lexer->get_token_index();
        $tok = $this->lexer->next_token();
        if (class_exists($tok) || interface_exists($tok)) {
            $string_rep = $this->lexer->get_tokens_from_index_to_current_index($start_index);

            $res_type = new PHPDocClassType($tok);
            $res_type->setRepresentation($string_rep);
            return $res_type;
        } else {
            $this->lexer->pushback();
            return null;
        }
    }
}
