{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form action="{$conf->action_root}citySave" method="post" class="pure-form pure-form-aligned">
            <fieldset>
                <legend>Miasta</legend>
                <div class="pure-control-group">
                    <label for="name">Nazwa miasta</label>
                    <input id="name" type="text" placeholder="nazwa" name="name" value="{$form->name}">
                </div>
                <div class="pure-controls">
                    <input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
                    <a class="pure-button button-secondary" href="{$conf->action_root}cityList">Powrót</a>
                </div>
            </fieldset>
            <input type="hidden" name="id" value="{$form->id}">
        </form>	
    </div>
{/block}
