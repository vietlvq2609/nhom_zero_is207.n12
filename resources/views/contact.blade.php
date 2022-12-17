<x-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   
<link rel="stylesheet" href="/assets/css/contact.css">

    <div class="contact">
        <div class="contact-img">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZzW6LlSmlwOTH5p9oQOlLNk2kgD50zC6kDg&usqp=CAU" alt="contact us">
        </div>
        <div class="contact-form">
            <form action="" method="POST">
                <h2>Get in touch</h2>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" require id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" require class="form-control">
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" require>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="5" class="form-control" require></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">SEND</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>