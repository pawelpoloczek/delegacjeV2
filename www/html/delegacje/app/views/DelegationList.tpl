{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form class="pure-form pure-form-stacked" action="{$conf->action_url}delegationList">
            <legend>Opcje wyszukiwania</legend>
            <fieldset>
                <input type="text" placeholder="Login użytkownika" name="personUserName" value="{$searchForm->personUserName}" />   
                    <button type="submit" class="pure-button pure-button-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
            </fieldset>
        </form>
    </div>	

{/block}

{block name=bottom}

    <div class="bottom-margin">
        <a class="pure-button button-success" href="{$conf->action_root}delegationNew"><i class="fa fa-plus-circle" aria-hidden="true"></i>
<i class="fa fa-globe" aria-hidden="true"></i>
</a>
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
                        <td>{$d["cityFrom"]}</td>
                        <td>{$d["cityTo"]}</td>
                        <td>{$d["name"]}, {$d["surname"]}, {$d["user_name"]}</td>
                        <td>{$d["brand"]}, {$d["model"]}, {$d["registration_number"]}</td>
                        <td>
                            <a class="button-small pure-button button-secondary" href="{$conf->action_url}delegationEdit/{$d['id']}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            &nbsp;
                            <a class="button-small pure-button button-warning" href="{$conf->action_url}delegationDelete/{$d['id']}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                {/strip}
            {/foreach}
        </tbody>
    </table>

{/block}
