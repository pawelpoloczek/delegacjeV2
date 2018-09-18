{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form class="pure-form pure-form-stacked" action="{$conf->action_url}delegationList">
            <legend>Opcje wyszukiwania</legend>
            <fieldset>
                <input type="text" placeholder="Osoba" name="sf_personId" value="{$searchForm->personId}" /><br />
                <button type="submit" class="pure-button pure-button-primary">Filtruj</button>
            </fieldset>
        </form>
    </div>	

{/block}

{block name=bottom}

    <div class="bottom-margin">
        <a class="pure-button button-success" href="{$conf->action_root}delegationNew">Dodaj delegację</a>
    </div>	

    <table id="tab_delegation" class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>Dystans</th>
                <th>Data rozpoczęcia</th>
                <th>Data zakończenia</th>
                <th>Miejsce rozpoczęcia</th>
                <th>Miejsce docelowe</th>
                <th>Pracownik</th>
                <th>Samochód</th>
                <th>Opcje</th>
            </tr>
        </thead>
        <tbody>
            {foreach $delegation as $d}
                {strip}
                    <tr>
                        <td>{$d["distance"]}</td>
                        <td>{$d["start_time"]}</td>
                        <td>{$d["end_time"]}</td>
                        <td>{$d["city_from"]}</td>
                        <td>{$d["city_to"]}</td>
                        <td>{$d["person_id"]}</td>
                        <td>{$d["car_id"]}</td>
                        <td>
                            <a class="button-small pure-button button-secondary" href="{$conf->action_url}delegationEdit/{$d['id']}">Edytuj</a>
                            &nbsp;
                            <a class="button-small pure-button button-warning" href="{$conf->action_url}delegationDelete/{$d['id']}">Usuń</a>
                        </td>
                    </tr>
                {/strip}
            {/foreach}
        </tbody>
    </table>

{/block}
