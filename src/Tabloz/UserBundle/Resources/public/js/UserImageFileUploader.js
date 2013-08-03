function PunkAveUserImageFileUploader(options)
{
  var self = this,
    uploadUrl = options.uploadUrl,
    viewUrl = options.viewUrl,
    $el = $(options.el),
    uploaderTemplate = _.template($('#file-uploader-template').html());
  $el.html(uploaderTemplate({}));

  var fileTemplate = _.template($('#file-uploader-file-template').html()),
    editor = $el.find('[data-files="1"]'),
    thumbnails = $el.find('[data-thumbnails="1"]');
  
  self.uploading = false;
  
  self.errorCallback = 'errorCallback' in options ? options.errorCallback : function( info ) { if (window.console && console.log) { console.log(info) } },

  self.addExistingFiles = function(files)
  {
    _.each(files, function(file) {
      appendEditableImage({
        // cmsMediaUrl is a global variable set by the underscoreTemplates partial of MediaItems.html.twig
        'thumbnail_url': viewUrl + '/thumbnails/' + file,
        'url': viewUrl + '/originals/' + file,
        'name': file
        });
    });
  };

  // Delay form submission until upload is complete.
  // Note that you are welcome to examine the
  // uploading property yourself if this isn't
  // quite right for you
  self.delaySubmitWhileUploading = function(sel)
  {
    $(sel).submit(function(e) {
        if (!self.uploading)
        {
            return true;
        }
        function attempt()
        {
            if (self.uploading)
            {
                setTimeout(attempt, 100);
            }
            else
            {
                $(sel).submit();
            }
        }
        attempt();
        return false;
    });
  }

  if (options.blockFormWhileUploading)
  {
    self.blockFormWhileUploading(options.blockFormWhileUploading);
  }

  if (options.existingFiles)
  {
    self.addExistingFiles(options.existingFiles);
  }

  editor.fileupload({
    url: uploadUrl
  });

  editor.fileupload({
  autoUpload: false,
    dataType: 'json',
    limitMultiFileUploads: 1,
    maxNumberOfFiles: 1,
    dropZone: $el.find('[data-dropzone="1"]'),
    maxFileSize: 5000000,
    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
    process: [
        {
            action: 'load',
            fileTypes: /^image\/(gif|jpeg|png)$/,
            maxFileSize: 2000000 // 2MB
        },
        {
            action: 'resize',
            maxWidth: 1440,
            maxHeight: 900
        },
        {
            action: 'save'
        }
    ],
    done: function (e, data) {
      $el.find('.uploader').removeClass('droppable_uploader');
      if (data)
      {
        _.each(data.result, function(item) {
          appendEditableImage(item);
        });
      }
      // selecting the crop area
      var croppable = $el.find('.croppable_image');
      croppable.imgAreaSelect({ 
    	  aspectRatio: '1:1', 
    	  handles: true,
    	  onSelectEnd: function (img, selection) {
	          $('input[name="x1"]').val(selection.x1);
	          $('input[name="y1"]').val(selection.y1);
	          $('input[name="x2"]').val(selection.x2);
	          $('input[name="y2"]').val(selection.y2);            
    	  } 
      });
      croppable.load(function(){ // display initial image selection 1:1
                  var height = this.width;
                  if( height <= this.height ){     
                          var diff = ( this.height - height ) / 2;
                          var coords = { x1 : 0, y1 : diff, x2 : this.width, y2 : height + diff };
                  }   
                  else{ // if new height out of bounds, scale width instead
                          var width = this.height; 
                          var diff = ( this.width - width ) / 2;
                          var coords = { x1 : diff, y1 : 0, x2 : width + diff, y2: this.height };
                  }   
              $( this ).imgAreaSelect( coords );
      });
      
    },
    start: function (e) {
      $el.find('[data-dropzone="1"]').hide();
      $el.find('[data-spinner="1"]').fadeIn();
      self.uploading = true;
    },
    stop: function (e) {
      $el.find('[data-spinner="1"]').hide();
      self.uploading = false;
    }
  });

  // Expects thumbnail_url, url, and name properties. thumbnail_url can be undefined if
  // url does not end in gif, jpg, jpeg or png. This is designed to work with the
  // result returned by the UploadHandler class on the PHP side
  function appendEditableImage(info)
  {
    if (info.error)
    {
      self.errorCallback(info);
      return;
    }
    var li = $(fileTemplate(info));
    li.find('[data-action="delete"]').click(function(event) {
      var file = $(this).closest('[data-name]');
      file.find(".crop_form").hide();
      $el.find('.croppable_image').imgAreaSelect( {remove: true} );
      var spinner = file.find(".spinner");
      spinner.fadeIn();
      var name = file.attr('data-name');
      $.ajax({
        type: 'delete',
        url: setQueryParameter(uploadUrl, 'file', name),
        success: function() {
          file.remove();
          $el.find('.uploader').addClass('droppable_uploader');
          $el.find('[data-dropzone="1"]').fadeIn();
          spinner.hide();
        },
        dataType: 'json'
      });
      return false;
    });

    thumbnails.append(li).hide().fadeIn();
  }

  function setQueryParameter(url, param, paramVal)
  {
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1]; 
    var temp = "";
    if (additionalURL)
    {
        var tempArray = additionalURL.split("&");
        var i;
        for (i = 0; i < tempArray.length; i++)
        {
            if (tempArray[i].split('=')[0] != param )
            {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }
    var newTxt = temp + "" + param + "=" + encodeURIComponent(paramVal);
    var finalURL = baseURL + "?" + newAdditionalURL + newTxt;
    return finalURL;
  }
}


