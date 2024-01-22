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
    // TODO: Implement load() method.
  }

  public function delete(IDao $dao)
  {
    // TODO: Implement delete() method.
  }

  public function exists(IDao $dao)
  {
    // TODO: Implement exists() method.
  }

  protected function _doDelete(IDao $dao)
  {
    // TODO: Implement _doDelete() method.
  }
}
