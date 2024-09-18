$(document).ready(function () {
    //@naresh action dynamic childs
    var next = ($('.tiny_domain').length)?$('.tiny_domain').length:0;
    $("body").on("click","#add-more",function(e){
      e.preventDefault();
        next = next + 1;
        var newIn = '<div class="row tiny_domain" id="tiny_domain_'+ (next - 1) +'"><div class="col-md-4"><div class="form-group"><label for="exampleInputEmail">Domain Name</label> <input class="form-control" id="exampleInputEmail" name="domain" placeholder="Enter Domain Name" value=""></div></div><div class="col-md-4"><div class="form-group"><br><button class="btn btn-danger remove-me" id="remove' + (next - 1) + '" name="add-more" type="button">Remove</button></div></div></div>';
        
        
        $("#tiny_domain").append(newIn);

    });
    $("body").on("click",".remove-me",function(e){
            e.preventDefault();
            var fieldNum = this.id.charAt(this.id.length-1);
            console.log("fieldNum=",fieldNum);
            $("#tiny_domain_"+fieldNum).remove();
    });

});