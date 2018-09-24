<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <meta charset="utf-8"/>
        <title>Delegacje by Adam Macha</title>
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css"
              integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
            <link rel="stylesheet" href="{$conf->app_url}/css/style.css">
                </head>

                <body style="margin: 20px;">

                    <div class="pure-menu pure-menu-horizontal bottom-margin">
                        {if count($conf->roles)===1}
                            <a href="{$conf->action_root}delegationList" class="pure-menu-heading pure-menu-link">Delegacje</a>
                            <a href="{$conf->action_root}cityList" class="pure-menu-heading pure-menu-link">Miasta</a>
                            <a href="{$conf->action_root}carList" class="pure-menu-heading pure-menu-link">Samochody</a>
                            <a href="{$conf->action_root}personList" class="pure-menu-heading pure-menu-link">Osoby</a>
                            <a href="{$conf->action_root}logout" class="pure-menu-heading pure-menu-link">Wyloguj</a>
                        {else}	
                            <center>Zaloguj się</center>
                            {/if}
                    </div>

                    {block name=top} {/block}

                    {block name=messages}

                        {if $msgs->isMessage()}
                            <div class="messages bottom-margin">
                                <ul>
                                    {foreach $msgs->getMessages() as $msg}
                                        {strip}
                                            <li class="msg {if $msg->isError()}error{/if} {if $msg->isWarning()}warning{/if} {if $msg->isInfo()}info{/if}">{$msg->text}</li>
                                            {/strip}
                                        {/foreach}
                                </ul>
                            </div>
                        {/if}

                    {/block}

                    {block name=bottom} {/block}

                </body>

                </html>