<?php declare(strict_types = 1);

namespace App\Presentation\Home;

use App\UI\Forms\PrimeNumber\PrimeNumberControl;
use App\UI\Forms\PrimeNumber\PrimeNumberFactory;
use Nette;

final class HomePresenter extends Nette\Application\UI\Presenter
{

    public function __construct(private PrimeNumberFactory $primeNumberFactory)
    {
    }

    protected function createComponentPrimeNumber(): PrimeNumberControl
    {
        return $this->primeNumberFactory->create();
    }

}
