



tinymce.init({
	selector: "textarea.tinymce",
	plugins: 'code print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable',
	tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
	tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
	tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
	tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
	mobile: {
	  plugins: 'code print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
	},
	menu: {
	  tc: {
		title: 'TinyComments',
		items: 'addcomment showcomments deleteallconversations'
	  }
	},
	menubar: false,//'file edit view insert format tools table tc help',
	toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat  | charmap emoticons |  preview | code | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
	autosave_ask_before_unload: true,
	autosave_interval: "30s",
	autosave_prefix: "{path}{query}-{id}-",
	autosave_restore_when_empty: false,
	autosave_retention: "2m",
	image_advtab: true,
	content_css: [
	  '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
	  '//www.tiny.cloud/css/codepen.min.css'
	],
	link_list: [
	  { title: 'My page 1', value: 'http://www.tinymce.com' },
	  { title: 'My page 2', value: 'http://www.moxiecode.com' }
	],
	image_list: [
	  { title: 'My page 1', value: 'http://www.tinymce.com' },
	  { title: 'My page 2', value: 'http://www.moxiecode.com' }
	],
	image_class_list: [
	  { title: 'None', value: '' },
	  { title: 'Some class', value: 'class-name' }
	],
	importcss_append: true,
	height: 400,
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
	noneditable_noneditable_class: "mceNonEditable",
	toolbar_drawer: false,//'sliding',
	spellchecker_dialog: true,
	spellchecker_whitelist: ['Ephox', 'Moxiecode'],
	tinycomments_mode: 'embedded',
	content_style: ".mymention{ color: gray; }",
	contextmenu: "link image imagetools table configurepermanentpen",
	/* 
	The following settings require more configuration than shown here.
	For information on configuring the mentions plugin, see:
	https://www.tiny.cloud/docs/plugins/mentions/.
	*/

   });
  
  