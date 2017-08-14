<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * function for check thumb image change
     * @param $elementLocator
     */
   public function seeThumbImageChanges($elementLocator)
   {
       $I = $this;
       $currentSrc = $I->grabAttributeFrom($elementLocator, 'src');
       for ($i=1; $i < 5; $i++) {
           $I->wait(1);
           //TODO change wait function to function waitForElementChange with callback which one will check 'src' change (if it necessary)
           $newSrc = $I->grabAttributeFrom($elementLocator, 'src');
           $this->assertNotEquals($currentSrc, $newSrc);
           $currentSrc = $newSrc;
       }
   }
}
