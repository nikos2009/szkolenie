<?php

/**
 * user actions.
 *
 * @package    employee
 * @subpackage user
 * @author     Your name here
 */
class userActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->users = UserPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->user = UserPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->user);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new userForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new userForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($user = UserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $this->form = new userForm($user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($user = UserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $this->form = new userForm($user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($user = UserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $user->delete();

    $this->redirect('user/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $user = $form->save();

      $this->redirect('user/edit?id='.$user->getId());
    }
  }
}
