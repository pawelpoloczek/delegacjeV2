$(document).ready(function(){
    if ($('.show-delegations').length  && $('.delegations').length) {
        $('.show-delegations').click(function() {
            var requestUrl = $(this).data('url');

            $.ajax({
                url: requestUrl
            })
            .done(function( data ) {
                if(data.length > 0) {
                    var table = '<table><tr><th>Dystans</th><th>Data rozpoczęcia</th><th>Data zakończenia</th><th>Miejsce rozpoczęcia</th>\n\
                                <th>Miejsce docelowe</th><th>Pracownik</th><th>Samochód</th></tr>';
                    $.each( data, function( index, value ){
                        table = table + '<tr><td>' + value.distance + '</td><td>' + value.start_time + '</td><td>' + value.end_time + '</td>\n\
                                <td>' + value.cityFrom + '</td><td>' + value.cityTo + '</td><td>' + value.name + ' ' + value.surname + '</td>\n\
                                <td>' + value.brand + ', ' + value.model + ', ' + value.registration_number + '</td></tr>';
                    });
                    table = table + '</table>';
                    
                    $('.delegations').html(table);
                } else {
                    $('.delegations').html('<h5>Nie znaleziono delegacji dla wybranego użytkownika.</h5>');
                }
            });
        });
    }
});