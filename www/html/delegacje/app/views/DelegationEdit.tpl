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
                    <select id="cityFrom" name="cityFrom">
                        <option value="">Wybierz miejsce początkowe</option>
                        {foreach from=$cities item=city}
                            <option value="{$city['id']}" {if $city['id'] == $form->cityFrom}selected="selected"{/if}>{$city['name']}</option>
                        {/foreach}
                    </select></div>
                <div class="pure-control-group">
                    <label for="cityTo">Miejsce docelowe</label>
                    <select id="cityTo" name="cityTo">
                        <option value="">Wybierz miejsce docelowe</option>
                        {foreach from=$cities item=city}
                            <option value="{$city['id']}" {if $city['id'] == $form->cityTo}selected="selected"{/if}>{$city['name']}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="pure-control-group">
                    <label for="personId">Pracownik</label>
                    <select id="personId" name="personId">
                        <option value="">Wybierz osobę</option>
                        {foreach from=$persons item=person}
                            <option value="{$person['id']}" {if $person['id'] == $form->personId}selected="selected"{/if}>{$person['name']} {$person['surname']} ({$person['user_name']})</option>
                        {/foreach}
                    </select>
                </div>
                <div class="pure-control-group">
                    <label for="carId">Samochód</label>
                    <select id="carId" name="carId">
                        <option value="">Wybierz samochód</option>
                        {foreach from=$cars item=car}
                            <option value="{$car['id']}" {if $car['id'] == $form->carId}selected="selected"{/if}>{$car['brand']}, {$car['model']}, {$car['registration_number']}</option>
                        {/foreach}
                    </select>
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
