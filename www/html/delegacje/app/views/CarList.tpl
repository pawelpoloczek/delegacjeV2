{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form class="pure-form pure-form-stacked" action="{$conf->action_url}carList">
            <legend>Opcje wyszukiwania</legend>
            <fieldset>
                <input type="text" placeholder="Numer rejestracyjny" name="sf_registrationNumber" value="{$searchForm->registrationNumber}" /><br />
                <button type="submit" class="pure-button pure-button-primary">Filtruj</button>
            </fieldset>
        </form>
    </div>	

{/block}

{block name=bottom}

    <div class="bottom-margin">
        <a class="pure-button button-success" href="{$conf->action_root}carNew">Dodaj samochód</a>
    </div>	

    <table id="tab_car" class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>Marka</th>
                <th>Model</th>
                <th>Numer rejestracyjny</th>
                <th>Pojemność</th>
                <th>Rok produkcji</th>
                <th>Opcje</th>
            </tr>
        </thead>
        <tbody>
            {foreach $car as $c}
                {strip}
                    <tr>
                        <td>{$c["brand"]}</td>
                        <td>{$c["model"]}</td>
                        <td>{$c["registration_number"]}</td>
                        <td>{$c["cubic_capacity"]}</td>
                        <td>{$c["production_year"]}</td>
                        <td>
                            <a class="button-small pure-button button-secondary" href="{$conf->action_url}carEdit/{$p['id']}">Edytuj</a>
                            &nbsp;
                            <a class="button-small pure-button button-warning" href="{$conf->action_url}carDelete/{$p['id']}">Usuń</a>
                        </td>
                    </tr>
                {/strip}
            {/foreach}
        </tbody>
    </table>

{/block}
