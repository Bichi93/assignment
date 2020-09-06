<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf_token" data-content="<?= csrf_hash() ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Add User</title>
</head>

<body>
    <div class="container">

        <table id="user-table" class="table table-bordered">

            <div id="table-message-list" style="margin-top: 40px; min-height: 60px"></div>
            <div class="col-12" style=" padding: 20px 0px 10px 10px;">
                <?php include('modals/user-add-modal.php'); ?>
            </div>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($users)) {
                    foreach ($users as $user) {
                        echo '<tr id="tr-' . $user->id . '">';
                        echo '<td>' . $user->id . '</td>';
                        echo '<td>' . $user->name . '</td>';
                        echo '<td>' . $user->last_name . '</td>';
                        echo '<td>' . $user->email . '</td>';
                        echo '<td>' . $user->phone . '</td>';
                        echo '<td class="text-center">
                                <a  data-target="#tr-' . $user->id . '" data-message-container="#table-message-list" data-href="' . base_url('/user/destroy/' . $user->id) . '" class="btn btn-danger delete-btn"> Delete</a>
                            </td>';
                        echo '</tr>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>
        $.fn.deleteModel = function() {
            $(this).on('click', function() {
                const el = $(this)
                const messageBox = $(el.data('message-container'));

                messageBox.empty();

                const result = confirm('Do you want to delete');

                if (result == true) {
                    $.ajax({
                        url: el.data('href'),
                        type: 'POST',
                        success: function(response) {
                            messageBox.append('<div class="alert alert-success"> ' + response + '</div')
                            $(el.data('target')).remove();
                        },
                        error: function(response) {
                            let errors = response.responseJSON.errors;
                            if (errors) {
                                $.each(errors, function(index, value) {
                                    messageBox.append('<div class="alert alert-danger"> ' + value + '</div');
                                });
                            }
                        }

                    });

                    setTimeout(function() {
                        messageBox.empty();
                    }, 1500);
                }
            });
        }

        $(document).ready(function() {

            let button = $('.open-modal');

            button.on('click', function() {
                let modal = $($(this).data('modal'));

                modal.modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            $('.ajax-form').on('submit', function(e) {
                e.preventDefault();

                const el = $(this);
                const modal = $('#add-user-modal');
                const data = $(this).serialize();

                modal.find('.error-list').empty();

                $.ajax({
                    url: el.data('action'),
                    type: el.data('method'),
                    data: data,
                    success: function(response) {

                        modal.find('.error-list').append('<div class="alert alert-success"> ' + response.message + '</div');

                        $('#user-table').prepend(response.view);
                        
                        $('.delete-btn-ajax').deleteModel();

                        modal.find('input').val('');

                        setTimeout(function() {
                            modal.modal('hide');
                            modal.find('.error-list').empty();
                        }, 300);
                        

                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(index, value) {
                                modal.find('.error-list').append('<div class="alert alert-danger"> ' + value + '</div');
                            });
                        }
                    }

                });

            });

            $('.delete-btn').deleteModel();

        });
    </script>
</body>

</html>