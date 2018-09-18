{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form class="pure-form pure-form-stacked" action="{$conf->action_url}cityList">
            <legend>Opcje wyszukiwania</legend>
            <fieldset>
                <input type="text" placeholder="Nazwa miasta" name="sf_name" value="{$searchForm->name}" /><br />
                <button type="submit" class="pure-button pure-button-primary">Filtruj</button>
            </fieldset>
        </form>
    </div>	

{/block}

{block name=bottom}

    <div class="bottom-margin">
        <a class="pure-button button-success" href="{$conf->action_root}cityNew">Dodaj miasto</a>
    </div>	

    <table id="tab_car" class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>Nazwa</th>
                <th>Opcje</th>
            </tr>
        </thead>
        <tbody>
            {foreach $city as $ci}
                {strip}
                    <tr>
                        <td>{$ci["name"]}</td>
                        <td>
                            <a class="button-small pure-button button-secondary" href="{$conf->action_url}cityEdit/{$ci['id']}">Edytuj</a>
                            &nbsp;
                            <a class="button-small pure-button button-warning" href="{$conf->action_url}cityDelete/{$ci['id']}">Usuń</a>
                        </td>
                    </tr>
                {/strip}
            {/foreach}
        </tbody>
    </table>

{/block}
