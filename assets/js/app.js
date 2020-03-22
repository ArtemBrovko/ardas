import 'bootstrap/dist/css/bootstrap.min.css'

import '@fortawesome/fontawesome-free/css/all.css';

import '../css/app.css';

import $ from 'jquery';
import 'bootstrap';

$(function () {
    $('.js-delete-button').click(function (e) {
        e.preventDefault();

        let $this = $(this);

        if (confirm('Delete this record?')) {
            $.post($this.attr('href'), {
                '_method': 'DELETE',
                '_token': $this.data('token')
            })
                .done(function () {
                    location.reload();
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                });
        }

        return false;
    });

    $(document).on('click', '.js-remove-li', function () {
        let $this = $(this);

        $this.closest('li').remove();
    });

    $('.js-collection-field').each((ind, item) => {
        let $item = $(item),
            prototype = $item.attr('data-prototype'),
            $target = $($item.attr('data-target'));

        $item.on('click', function (e) {
            e.preventDefault();
            $target.append(prototype.replace(/__name__/g, $target.children().length));

            return false;
        });
    });

});
