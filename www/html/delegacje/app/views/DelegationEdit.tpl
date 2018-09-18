{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form action="{$conf->action_root}carSave" method="post" class="pure-form pure-form-aligned">
            <fieldset>
                <legend>Dane samochodu</legend>
                <div class="pure-control-group">
                    <label for="brand">Marka</label>
                    <input id="brand" type="text" placeholder="marka" name="brand" value="{$form->brand}">
                </div>
                <div class="pure-control-group">
                    <label for="model">Model</label>
                    <input id="model" type="text" placeholder="model" name="model" value="{$form->model}">
                </div>
                <div class="pure-control-group">
                    <label for="registrationNumber">Numer rejestracyjny</label>
                    <input id="registrationNumber" type="text" placeholder="numer rejestracyjny" name="registrationNumber" value="{$form->registrationNumber}">
                </div>
                <div class="pure-control-group">
                    <label for="cubicCapacity">Pojemność skokowa</label>
                    <input id="cubicCapacity" type="text" placeholder="pojemność skokowa" name="cubicCapacity" value="{$form->cubicCapacity}">
                </div>
                <div class="pure-control-group">
                    <label for="productionYear">Rok produkcji</label>
                    <input id="productionYear" type="text" placeholder="rok produkcji" name="productionYear" value="{$form->productionYear}">
                </div>
                <div class="pure-controls">
                    <input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
                    <a class="pure-button button-secondary" href="{$conf->action_root}carList">Powrót</a>
                </div>
            </fieldset>
            <input type="hidden" name="id" value="{$form->id}">
        </form>	
    </div>
{/block}
