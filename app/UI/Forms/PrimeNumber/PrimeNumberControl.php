<?php declare(strict_types = 1);

namespace App\UI\Forms\PrimeNumber;

use App\Utils\Math\PrimeNumber\TableFactory;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Application\UI\Template;

class PrimeNumberControl extends Control
{

    #[Persistent]
    public ?int $size = null;

    public function __construct(private TableFactory $tableFactory)
    {
    }

    public function render(): void
    {
        /** @var Template $template */
        $template = $this->template;
        $template->size = $this->size;
        $template->table = null;
        if ($this->size !== null) {
            $table = $this->tableFactory->create($this->size);
            $template->rows = $table->rows;
            $template->primeNumbers = $table->primeNumbers;
            $template->table = $this->tableFactory->create($this->size)->toArray();
        }

        $template->setFile(__DIR__ . '/default.latte');
        $template->render();
    }

    public function formSucceeded(Form $form, PrimeNumberData $data): void
    {
        $this->size = $data->size;
        $this->getPresenter()->redrawControl();
        $this->redrawControl();
    }

    protected function createComponentPrimeNumberForm(): Form
    {
        $form = new Form();
        $form->setMappedType(PrimeNumberData::class);
        $form->setHtmlAttribute('class', 'ajax row g-2 align-items-center');
        $form->addInteger('size', 'Počet:')
            ->setRequired('Zadejte počet')
            ->addRule($form::Min, 'Počet musí být větší jak 0.', 1)
            ->setHtmlAttribute('class', 'form-control')
            ->setDefaultValue(1);

        $form->addSubmit('send', 'Odeslat')
            ->setHtmlAttribute('class', 'btn btn-primary');
        $form->onSuccess[] = function (Form $form, $data): void {
            /** @var PrimeNumberData $data */
            $this->formSucceeded($form, $data);
        };
        $form->addProtection();

        return $form;
    }

}
