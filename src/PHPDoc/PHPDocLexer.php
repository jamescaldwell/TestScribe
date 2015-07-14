<?php

namespace Box\TestScribe\PHPDoc;

use Box\TestScribe;

class PHPDocLexer {
    const DELIMITERS = '/([\[\]\|\(\)\*\?])/';

    /** @var string[] */
    protected $tokens;
    /** @var int */
    protected $token_index;

    /**
     * @param string $str
     */
    public function  __construct($str) {
        $this->tokens = preg_split(self::DELIMITERS, $str, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $this->token_index=0;
    }

    /**
     * @return void
     */
    public function pushback() {
        TestScribe\Assert::with('Box\TestScribe\PHPDoc\PHPDoc_Lexer_Exception')->are_not_equal(0, $this->token_index, "nothing to push back");
        $this->token_index--;
    }

    /**
     * @return string|null
     */
    public function next_token() {
        if ($this->token_index == count($this->tokens)) {
            return null;
        }
        return $this->tokens[$this->token_index++];
    }

    /**
     * @return bool
     */
    public function has_more() {
        return $this->token_index < count($this->tokens);
    }

    /**
     * @return int
     */
    public function get_token_index() {
        return $this->token_index;
    }

    /**
     * @param int $index starting index
     * @return string tokens in the given range
     */
    public function get_tokens_from_index_to_current_index($index) {
        return implode(array_slice($this->tokens, $index, $this->token_index - $index));
    }

    /**
     * @return string remaining input
     */
    public function get_remaining_input() {
        return implode(array_slice($this->tokens, $this->token_index));
    }
}

class PHPDoc_Lexer_Exception extends \Exception
{

}
