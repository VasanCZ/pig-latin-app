<?php

declare(strict_types=1);

namespace App\MainModule\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use App\MainModule\Model\PigLatinManager;

final class PigLatinPresenter extends Presenter {

    private string $outputText = "";
    private $pigLatinManager;

    public function __construct(PigLatinManager $pigLatinManager) {
        $this->pigLatinManager = $pigLatinManager;
    }

    public function renderDefault(): void {
        $this->template->translatedText = $this->outputText;
    }

    protected function createComponentInputForm(): Form {
        $form = new Form();
        $form->addTextArea('text', '')
            ->addRule($form::MAX_LENGTH, 'Max input length is 500', 500)
            ->setHtmlAttribute('placeholder', 'Text to translate')
            ->setAttribute('rows', 10)
            ->setAttribute('cols', 50);
        $form->addSubmit('translate', 'Translate');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded(Form $form, $inputText): void {
        $this->outputText = $this->pigLatinManager->translateToPigLatin($inputText->text);
    }
}
