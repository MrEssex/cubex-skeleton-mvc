<?php
namespace MrEssex\CubexSkeleton\Tests\Mocks;

use Packaged\Dal\Foundation\AbstractDataStore;
use Packaged\Dal\IDao;

class MockDataStore extends AbstractDataStore
{
  public function save(IDao $dao)
  {
    parent::save($dao);
    return $dao->getDaoChanges();
  }

  public function load(IDao $dao)
  {
    return $dao;
  }

  public function delete(IDao $dao)
  {
    return $dao;
  }

  public function exists(IDao $dao)
  {
    return true;
  }

  protected function _doDelete(IDao $dao)
  {
    return $dao;
  }
}
