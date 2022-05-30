<?php

declare(strict_types=1);

namespace App\MainModule\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;

/**
 * @property string $inputText
 */

final class PigLatinPresenter extends Presenter {

    private string $inputText = "";

    public function getInputText(): string {
        return $this->inputText;
    }

    public function setInputText($inputText): void {
        $this->inputText = $inputText;
    }

    public function __construct() {
        
    }

    public function renderDefault(): void {
        $this->template->translatedText = $this->getInputText();
    }

    protected function createComponentInputForm(): Form {
        $form = new Form();
        $form->addTextArea('text', '')->addRule($form::MAX_LENGTH, 'Max input length is 500', 500);
        $form->addSubmit('translate', 'Translate');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded(Form $form, $inputText): void {
        $this->setInputText($inputText->text);
    }
}
