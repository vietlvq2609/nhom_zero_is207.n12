<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="form-insert-form">
    <form action="" method="POST">
    @csrf
        <h2>Insert User</h2>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" require >
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="text" class="form-control" id="avatar" name="avatar" require>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" require>
        </div>
        <div class="form-control">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" require>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" require>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Insert</button>
        </div>
    </form>
</div>