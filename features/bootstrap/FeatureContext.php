<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit_Framework_Assert as PHPUnit;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    protected $rules;
    protected $setting;
    protected $character;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given /^I have test rules$/
     */
    public function iHaveTestRules()
    {
        $this->rules = new TG\Rules\Test();
    }

    /**
     * @Given /^I have test setting$/
     */
    public function iHaveTestSetting()
    {
        $this->setting = new TG\Setting\Test();
    }

    /**
     * @When /^I generate character$/
     */
    public function iGenerateCharacter()
    {
        $generator = new TG\Generator\Character();
        $this->character = $generator->generate($this->rules);
    }

    /**
     * @Then /^Character's "([^"]*)" should be between (\d+) and (\d+)$/
     */
    public function characterSShouldBeBetweenAnd($attribute, $minValue, $maxValue)
    {
        $actualValue = $this->character->get($attribute);

        PHPUnit::assertGreaterThanOrEqual($minValue, $actualValue);
        PHPUnit::assertLessThanOrEqual($maxValue, $actualValue);
    }
}
