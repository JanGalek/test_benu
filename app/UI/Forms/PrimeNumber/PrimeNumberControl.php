<?php declare(strict_types = 1);

namespace App\UI\Forms\PrimeNumber;

use App\Utils\Math\PrimeNumber\TableFactory;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class PrimeNumberControl extends Control
{

    #[Persistent]
    public ?int $size = null;

    public function __construct(private TableFactory $tableFactory)
    {
    }

    public function formSucceeded(Form $form, array $data): void
    {
        $this->size = $data['size'];
        $this->getPresenter()->redrawControl();
    }

    public function render(): void
    {
        $this->template->size = $this->size;
        $this->template->table = null;
        if ($this->size !== null) {
            $table = $this->tableFactory->create($this->size);
            $this->template->rows = $table->rows;
            $this->template->primeNumbers = $table->primeNumbers;
            $this->template->table = $this->tableFactory->create($this->size)->toArray();
        }

        $this->template->render(__DIR__ . '/default.latte');
    }

    protected function createComponentPrimeNumberForm(): Form
    {
        $form = new Form();
        $form->setHtmlAttribute('class', 'ajax');
        $form->addInteger('size', 'Počet:')
            ->setRequired('Zadejte počet')
            ->addRule($form::Min, 'Počet musí být větší jak 0.', 1)
            ->setHtmlAttribute('class', 'form-label');

        $form->addSubmit('send', 'Odeslat')
            ->setHtmlAttribute('class', 'btn btn-primary');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        $form->addProtection();

        return $form;
    }

}
