{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form action="{$conf->action_root}delegationSave" method="post" class="pure-form pure-form-aligned">
            <fieldset>
                <legend>Dane delegacji</legend>
                <div class="pure-control-group">
                    <label for="distance">Dystans</label>
                    <input id="distance" type="text" placeholder="dystans" name="distance" value="{$form->distance}">
                </div>
                <div class="pure-control-group">
                    <label for="startTime">Data rozpoczęcia</label>
                    <input id="startTime" type="text" placeholder="data rozpoczęcia" name="startTime" value="{$form->startTime}">
                </div>
                <div class="pure-control-group">
                    <label for="endTime">Data zakończenia</label>
                    <input id="endTime" type="text" placeholder="data zakończenia" name="endTime" value="{$form->endTime}">
                </div>
                <div class="pure-control-group">
                    <label for="cityFrom">Miejsce początkowe</label>
                    <input id="cityFrom" type="text" placeholder="" name="cityFrom" value="{$form->cityFrom}">
                </div>
                <div class="pure-control-group">
                    <label for="cityTo">Miejsce docelowe</label>
                    <input id="cityTo" type="text" placeholder="" name="cityTo" value="{$form->cityTo}">
                </div>
                <div class="pure-control-group">
                    <label for="personId">Pracownik</label>
                    <input id="personId" type="text" placeholder="" name="personId" value="{$form->personId}">
                </div>
                <div class="pure-control-group">
                    <label for="carId">Samochód</label>
                    <input id="carId" type="text" placeholder="" name="carId" value="{$form->carId}">
                </div>
                <div class="pure-controls">
                    <input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
                    <a class="pure-button button-secondary" href="{$conf->action_root}delegationList">Powrót</a>
                </div>
            </fieldset>
            <input type="hidden" name="id" value="{$form->id}">
        </form>	
    </div>
{/block}
