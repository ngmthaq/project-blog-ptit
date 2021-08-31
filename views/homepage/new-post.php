<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New post</title>
    <?php require_once('./views/parts/__head.php') ?>
</head>

<body>
    <div class="main">
        <div class="container">
            <h1>Classic editor</h1>
            <form action="index.php?controller=admin&action=newPost" method="POST" enctype="multipart/form-data">
                <label for="title">Title</label>
                <textarea name="title" id="title"></textarea>

                <label for="subtitle">Subtitle</label>
                <textarea name="subtitle" id="subtitle"></textarea>
                <br>

                <div class="form-group">
                    <label for="img_1">Image 1</label><br>
                    <input type="file" name="img[]" id="img_1" class="form-controller-file">
                </div>

                <label for="paragraph_1">Paragraph</label>
                <textarea name="paragraph_1" id="paragraph_1"></textarea>
                <br>

                <div class="form-group">
                    <label for="img_2">Image 2</label><br>
                    <input type="file" name="img[]" id="img_2" class="form-controller-file">
                </div>

                <label for="paragraph_2">Paragraph</label>
                <textarea name="paragraph_2" id="paragraph_2"></textarea>
                <br>

                <div class="form-group">
                    <label for="img_3">Image 3</label><br>
                    <input type="file" name="img[]" id="img_3" class="form-controller-file">
                </div>

                <label for="paragraph_3">Paragraph</label>
                <textarea name="paragraph_3" id="paragraph_3"></textarea>
                <br>
                <button type="submit" name="submit" class="btn btn-sm btn-primary mb-2">Đăng bài</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#title'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#subtitle'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_3'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>