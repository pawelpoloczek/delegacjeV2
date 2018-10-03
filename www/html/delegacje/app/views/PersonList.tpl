{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form class="pure-form pure-form-stacked" action="{$conf->action_url}personList">
            <legend>Opcje wyszukiwania</legend>
            <fieldset>
                <input type="text" placeholder="nazwisko" name="sf_surname" value="{$searchForm->surname}" />
                <button type="submit" class="pure-button pure-button-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
            </fieldset>
        </form>
    </div>	

{/block}

{block name=bottom}

    <div class="bottom-margin">
        <a class="pure-button button-success" href="{$conf->action_root}personNew">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
            <i class="fa fa-users" aria-hidden="true"></i>
        </a>
    </div>
    <table id="tab_people" class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>imię</th>
                <th>nazwisko</th>
                <th>data ur.</th>
                <th>stanowisko</th>
                <th>miejsce pracy</th>
                <th>nazwa użytkownika</th>
                <th>rola</th>
                <th>opcje</th>
            </tr>
        </thead>
        <tbody>
            {foreach $people as $p}
                {strip}
                    <tr>
                        <td>{$p["name"]}</td>
                        <td>{$p["surname"]}</td>
                        <td>{$p["birthdate"]}</td>
                        <td>{$p["job_title"]}</td>
                        <td>{$p["job_place"]}</td>
                        <td>{$p["user_name"]}</td>
                        <td>{$p["role"]}</td>
                        <td>
                            <a class="button-small pure-button button-secondary" href="{$conf->action_url}personEdit/{$p['id']}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>&nbsp;
                            <a class="button-small pure-button button-warning" href="{$conf->action_url}personDelete/{$p['id']}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a> &nbsp;
                            <a class="show-delegations" data-url="{$conf->action_url}delegationAjax?user={$p['id']}" href="#">Pokaż delegacje</a>
                        </td>
                    </tr>
                {/strip}
            {/foreach}
        </tbody>
    </table>
    <div class='delegations'></div>
    <script type="text/javascript" src="{$conf->app_url}/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="{$conf->app_url}/js/main.js"></script>
{/block}