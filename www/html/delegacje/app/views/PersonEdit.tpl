{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form action="{$conf->action_root}personSave" method="post" class="pure-form pure-form-aligned">
            <fieldset>
                <legend>Dane osoby</legend>
                <div class="pure-control-group">
                    <label for="name">imię</label>
                    <input id="name" type="text" placeholder="imię" name="name" value="{$form->name}">
                </div>
                <div class="pure-control-group">
                    <label for="surname">nazwisko</label>
                    <input id="surname" type="text" placeholder="nazwisko" name="surname" value="{$form->surname}">
                </div>
                <div class="pure-control-group">
                    <label for="birthdate">data ur.</label>
                    <input id="birthdate" type="text" placeholder="data ur." name="birthdate" value="{$form->birthdate}">
                </div>
                <div class="pure-control-group">
                    <label for="jobTitle">stanowisko</label>
                    <input id="jobTitle" type="text" placeholder="stanowisko" name="jobTitle" value="{$form->jobTitle}">
                </div>
                <div class="pure-control-group">
                    <label for="jobPlace">miejsce pracy</label>
                    <input id="jobPlace" type="text" placeholder="miejsce pracy" name="jobPlace" value="{$form->jobPlace}">
                </div>
                <div class="pure-control-group">
                    <label for="userName">nazwa użytkownika</label>
                    <input id="userName" type="text" placeholder="nazwa użytkownika" name="userName" value="{$form->userName}">
                </div>
                <div class="pure-control-group">
                    <label for="role">rola</label>
                    <input id="role" type="text" placeholder="rola" name="role" value="{$form->role}">
                </div>
                <div class="pure-control-group">
                    <label for="password">hasło</label>
                    <input id="password" type="password" placeholder="hasło" name="password" value="{$form->password}">
                </div>
                <div class="pure-controls">
                    <input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
                    <a class="pure-button button-secondary" href="{$conf->action_root}personList">Powrót</a>
                </div>
            </fieldset>
            <input type="hidden" name="id" value="{$form->id}">
        </form>	
    </div>

{/block}
