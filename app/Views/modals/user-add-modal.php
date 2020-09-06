<button class="btn btn-primary open-modal" style="margin-bottom: 10px; float: right;" data-modal="#add-user-modal">Add User </button>

<div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="error-list"></div>
                <div class="row">
                    <div class="col-12">
                        <form data-action="<?= base_url('/user/add') ?>" data-method="POST" class="ajax-form col-12">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="mail" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <Button type="submit" class="btn btn-primary">Add User</Button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>