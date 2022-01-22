<?php if (!$this->form->isValid()) { ?>
    <div class="message-info message-error">
        Corectati campurile marcate cu rosu:
    </div>
<?php } else { ?>
    <div class="message-info">
        Instructiuni:
        <ul>
            <li>
                Puteti <b>previzualiza</b> descrierea apasand pe primul buton de pe
                bara de unelte a editorului text.
            </li>
        </ul>
    </div>
<?php } ?>
