<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZfcRbac\Controller\RbacSecuredInterface;

class BarController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
