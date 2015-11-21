<?php

/**
 * wizytowka actions.
 *
 * @package    employee
 * @subpackage wizytowka
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class wizytowkaActions extends sfActions
{
    const POSITION = 'Software Developer';

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->name = $request->getParameter('name');
      $this->surname = $request->getParameter('surname');
      $this->position = self::POSITION;
      $this->mail = sprintf("%s.%s@mokyokit.com", mb_strtolower($this->name), mb_strtolower($this->surname));
      $this->phone = $request->getParameter('phone');
  }
}
