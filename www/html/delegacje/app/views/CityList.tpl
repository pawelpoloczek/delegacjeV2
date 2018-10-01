{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form class="pure-form pure-form-stacked" action="{$conf->action_url}cityList">
            <legend>Opcje wyszukiwania</legend>
            <fieldset>
                <input type="text" placeholder="Nazwa miasta" name="name" value="{$searchForm->name}" />
                <button type="submit" class="pure-button pure-button-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
            </fieldset>
        </form>
    </div>	

{/block}

{block name=bottom}

    <div class="bottom-margin">
        <a class="pure-button button-success" href="{$conf->action_root}cityNew"><i class="fa fa-plus-circle" aria-hidden="true"></i>
<i class="fa fa-building" aria-hidden="true"></i>
</a>
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
                            <a class="button-small pure-button button-secondary" href="{$conf->action_url}cityEdit/{$ci['id']}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            &nbsp;
                            <a class="button-small pure-button button-warning" href="{$conf->action_url}cityDelete/{$ci['id']}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                {/strip}
            {/foreach}
        </tbody>
    </table>

{/block}
