<!----------------

    Name: Wanzhen Gao
    Date: 2020-10-06
    Description: Create new Pets 

----------------->
<?php
	require 'authenticate.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create a new Animal</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="https://cdn.tiny.cloud/1/902l19u010f3fxvbsuwvrypd3pz3ppygh260mf0re5krhmcx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

tinymce.init({
  selector: 'textarea',
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: '30s',
  autosave_prefix: '{path}{query}-{id}-',
  autosave_restore_when_empty: false,
  autosave_retention: '2m',
  image_advtab: true,
  link_list: [
    { title: 'My page 1', value: 'https://www.tiny.cloud' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
    { title: 'My page 1', value: 'https://www.tiny.cloud' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog */
    if (meta.filetype === 'file') {
      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    }

    /* Provide image and alt text for the image dialog */
    if (meta.filetype === 'image') {
      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
    }

    /* Provide alternative source and posted for the media dialog */
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
    }
  },
  templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: 'mceNonEditable',
  toolbar_mode: 'sliding',
  contextmenu: 'link image imagetools table',
  skin: useDarkMode ? 'oxide-dark' : 'oxide',
  content_css: useDarkMode ? 'dark' : 'default',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
 });

  </script>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="create.php">Create a new Animal</a></h1>
        </div> <!-- END div id="header" -->
<ul id="menu">
    <li><a href="index.php" class='active'>Home</a></li>
    <li><a href="category.php" >Categories</a></li>
    <li><a href="admin.php" >Admin</a></li>
    <li><a href="create.php" >Create New Animal</a></li>
</ul> <!-- END div id="menu" -->
<div id="all_pets">
  <form action="process_post.php" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend>New Animal</legend>
      <p>
        <label for="Name">Name</label>
        <input name="Name" id="Name" />
      </p>

      <p>
        <label for="Location">Shelter Location</label>
        <input name="Location" id="Location" />
      </p>
      <p>
        <label for="Age">Age</label>
        <input name="Age" id="Age"/>
      </p>
      <p>
        <label for="Sex">Sex</label>
        <input name="Sex" id="Sex" />
      </p>
      <p>
        <label for="Breed">Breed</label>
        <input name="Breed" id="Breed" />
      </p>
      <p>
        <label for="About">About</label>
        <textarea name="About" id="About"></textarea>
      </p>
      <p>
        <label for="CategoryID">Category</label>
        <input name="CategoryID" id="CategoryID" />
      </p>
      <p>
        <label for='Image'>Animal Image</label>
        <input type='file' name='Image' id='Image'/>
      </p>
      <p>
        <input type="submit" name="command" value="Create" />
      </p>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Copywrong 2020 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
