{extends file="main.tpl"}

{block name=top}

    <div class="bottom-margin">
        <form class="pure-form pure-form-stacked" action="{$conf->action_url}carList">
            <legend>Opcje wyszukiwania</legend>
            <fieldset>
                <input type="text" placeholder="Numer rejestracyjny" name="registrationNumber" value="{$searchForm->registrationNumber}" />
                <button type="submit" class="pure-button pure-button-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
            </fieldset>
        </form>
    </div>	

{/block}

{block name=bottom}

    <div class="bottom-margin">
        <a class="pure-button button-success" href="{$conf->action_root}carNew"><i class="fa fa-plus-circle" aria-hidden="true"></i>
<i class="fa fa-car" aria-hidden="true"></i>
</a>
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
                            <a class="button-small pure-button button-secondary" href="{$conf->action_url}carEdit/{$c['id']}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            &nbsp;
                            <a class="button-small pure-button button-warning" href="{$conf->action_url}carDelete/{$c['id']}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                {/strip}
            {/foreach}
        </tbody>
    </table>

{/block}
