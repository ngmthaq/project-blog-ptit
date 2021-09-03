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
            <h1>CKeditor</h1>
            <form action="index.php?controller=admin&action=newPost" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="category">Danh mục</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Chọn danh mục ...</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo (isset($err['category_id'])) ? '<small class="text-danger d-block">'.$err['category_id'].'</small>' : '' ?>
                    </div>
                    <div class="form-group col-6">
                        <label for="date">Ngày đăng</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                </div>

                <fieldset>
                    <legend>Mở bài</legend>
                    <label for="title">Tiêu đề 1</label>
                    <textarea name="title" id="title"></textarea>
                    <?php echo (isset($err['title'])) ? '<small class="text-danger d-block">'.$err['title'].'</small>' : '' ?>

                    <label for="subtitle">Tiêu đề phụ</label>
                    <textarea name="subtitle" id="subtitle"></textarea>
                    <?php echo (isset($err['subtitle'])) ? '<small class="text-danger d-block">'.$err['subtitle'].'</small>' : '' ?>
                    <br>

                    <div class="form-group">
                        <label for="cover">Ảnh bìa</label><br>
                        <input type="file" name="img[]" id="cover" class="form-controller-file">
                        <?php echo (isset($err['img_0'])) ? '<small class="text-danger d-block">'.$err['img_0'].'</small>' : '' ?>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Thân bài</legend>

                    <!-- HEADING 1 -->
                    <fieldset>
                        <legend><small>Đoạn 1</small></legend>
                        <label for="heading_1">Tiêu đề:</label>
                        <textarea name="heading_1" id="heading_1"></textarea>
                        <?php echo (isset($err['heading_1'])) ? '<small class="text-danger d-block">'.$err['heading_1'].'</small>' : '' ?>
                        <br>

                        <label for="paragraph_1_1">Content:</label>
                        <textarea name="paragraph_1_1" id="paragraph_1_1"></textarea>
                        <?php echo (isset($err['paragraph_1_1'])) ? '<small class="text-danger d-block">'.$err['paragraph_1_1'].'</small>' : '' ?>
                        <br>

                        <div class="form-group">
                            <label for="img_1">Ảnh</label><br>
                            <input type="file" name="img[]" id="img_1" class="form-controller-file">
                            <?php echo (isset($err['img_1'])) ? '<small class="text-danger d-block">'.$err['img_1'].'</small>' : '' ?>
                        </div>

                        <label for="paragraph_1_2">Content:</label>
                        <textarea name="paragraph_1_2" id="paragraph_1_2"></textarea>
                        <?php echo (isset($err['paragraph_1_2'])) ? '<small class="text-danger d-block">'.$err['paragraph_1_2'].'</small>' : '' ?>
                        <br>
                    </fieldset>

                    <!-- HEADING 2 -->
                    <fieldset>
                        <legend><small>Đoạn 2</small></legend>
                        <label for="heading_2">Tiêu đề:</label>
                        <textarea name="heading_2" id="heading_2"></textarea>
                        <?php echo (isset($err['heading_2'])) ? '<small class="text-danger d-block">'.$err['heading_2'].'</small>' : '' ?>
                        <br>

                        <label for="paragraph_2_1">Content:</label>
                        <textarea name="paragraph_2_1" id="paragraph_2_1"></textarea>
                        <?php echo (isset($err['paragraph_2_1'])) ? '<small class="text-danger d-block">'.$err['paragraph_2_1'].'</small>' : '' ?>
                        <br>

                        <div class="form-group">
                            <label for="img_2">Ảnh</label><br>
                            <input type="file" name="img[]" id="img_2" class="form-controller-file">
                            <?php echo (isset($err['img_2'])) ? '<small class="text-danger d-block">'.$err['img_2'].'</small>' : '' ?>
                        </div>

                        <label for="paragraph_2_2">Content:</label>
                        <textarea name="paragraph_2_2" id="paragraph_2_2"></textarea>
                        <?php echo (isset($err['paragraph_2_2'])) ? '<small class="text-danger d-block">'.$err['paragraph_2_2'].'</small>' : '' ?>
                        <br>
                    </fieldset>

                    <!-- HEADING 3 -->
                    <fieldset>
                        <legend><small>Đoạn 3</small></legend>
                        <label for="heading_3">Tiêu đề:</label>
                        <textarea name="heading_3" id="heading_3"></textarea>
                        <?php echo (isset($err['heading_3'])) ? '<small class="text-danger d-block">'.$err['heading_3'].'</small>' : '' ?>
                        <br>

                        <label for="paragraph_3_1">Content:</label>
                        <textarea name="paragraph_3_1" id="paragraph_3_1"></textarea>
                        <?php echo (isset($err['paragraph_3_1'])) ? '<small class="text-danger d-block">'.$err['paragraph_3_1'].'</small>' : '' ?>
                        <br>

                        <div class="form-group">
                            <label for="img_3">Ảnh</label><br>
                            <input type="file" name="img[]" id="img_3" class="form-controller-file">
                            <?php echo (isset($err['img_3'])) ? '<small class="text-danger d-block">'.$err['img_3'].'</small>' : '' ?>
                        </div>

                        <label for="paragraph_3_2">Content:</label>
                        <textarea name="paragraph_3_2" id="paragraph_3_2"></textarea>
                        <?php echo (isset($err['paragraph_3_2'])) ? '<small class="text-danger d-block">'.$err['paragraph_3_2'].'</small>' : '' ?>
                        <br>
                    </fieldset>
                </fieldset>

                <fieldset>
                    <legend>Kết bài</legend>
                    <label for="last_paragraph">Content</label>
                    <textarea name="last_paragraph" id="last_paragraph"></textarea>
                    <?php echo (isset($err['last_paragraph'])) ? '<small class="text-danger d-block">'.$err['last_paragraph'].'</small>' : '' ?>
                    <br>
                </fieldset>

                <button type="submit" name="submit" class="btn btn-sm btn-primary mb-2" value="submit">Đăng bài</button>
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
            .create(document.querySelector('#heading_1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#heading_2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#heading_3'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_1_1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_1_2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_2_1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_2_2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_3_1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#paragraph_3_2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#last_paragraph'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>