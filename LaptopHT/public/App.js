function check_Input(input, domain, md) {
     var inp = $(input);
     var form = $(input).parents('form');
     var val = $(input).val();
     var n = $(input).attr("name");
     $.post(
          domain + "/Ajax/Check_Input/",
          {
               val: val,
               md: md,
               fn: n,
          },
          function (data) {
               var d = JSON.parse(data);
               console.log(d);
               $("label[mess=" + n + "]").html(d[0]);
               if (d.length == 1) {
                    inp.removeClass("border-danger").addClass("border-primary").addClass("inp1").removeClass("inp0");
                    $("label[mess=" + n + "]").css("color", "blue");
               } else {
                    inp.addClass("border-danger").removeClass("border-primary").addClass("inp0").removeClass("inp1");
                    $("label[mess=" + n + "]").css("color", "red");
               }
               var vali = form.find("input[vali]:not([no-re])");
               var inp0 = form.find(".inp0");
               var vali1 = form.find("input.inp1[vali]:not([no-re])");
               console.log(vali.length+"---"+vali1.length);
               if (inp0.length == 0 && vali1.length == vali.length)
                    form.find("button[type='submit']").removeClass("disabled");
               else form.find("button[type='submit']").addClass("disabled");
          }
     );
}
var imagesPreview = function(input, placeToInsertImagePreview) {
     $(placeToInsertImagePreview).html("");
     if (input.files) {
         var filesAmount = input.files.length;

         for (i = 0; i < filesAmount; i++) {
             var reader = new FileReader();
             reader.onload = function(event) {
                 // $($.parseHTML('<img>')).attr('src', event.target.result).addClass("col p-2").appendTo(placeToInsertImagePreview);
                 var khung = $($.parseHTML('<div>')).addClass("p-1 col p-1").appendTo(placeToInsertImagePreview);
                 $($.parseHTML('<img>')).attr('src', event.target.result).css("width", "100%").addClass("border").appendTo(khung);
             }
             reader.readAsDataURL(input.files[i]);
         }
     }
 };