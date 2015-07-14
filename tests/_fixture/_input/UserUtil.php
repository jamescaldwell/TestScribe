<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * Class UserUtil
 */
class UserUtil
{
    /**
     * @param \Box\TestScribe\_fixture\_input\User $user
     *
     * @return string
     */
    public function says(User $user)
    {
        $sentence = sprintf("%s says hello.\n", $user->getName());
        return $sentence;
    }

    /**
     * @param \Box\TestScribe\_fixture\_input\User                $user
     * @param \Box\TestScribe\_fixture\_input\CalculatorWithState $calculator
     *
     * @return string
     */
    public function userCalculatorState(
        $user,
        $calculator
    )
    {
        $name = $user->getName();
        $initialValue = $calculator->getState();
        $calculatorState = $calculator->add(1);
        $sentence = sprintf(
            "%s's calculator has the value %d after adding one to the intitial value of %d.",
            $name,
            $calculatorState,
            $initialValue
        );

        return $sentence;
    }

    /**
     * @param \Box\TestScribe\_fixture\_input\User $user
     *
     * @return array
     */
    public function showMeYourNames($user)
    {
        return $user->getNameHistory();
    }

    /**
     * @param \Box\TestScribe\_fixture\_input\User   $user
     * @param string $newName
     *
     * @return string
     */
    public function changeName($user, $newName)
    {
        $user->changeName($newName);

        return $user->getName();
    }
}
