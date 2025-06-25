jQuery(document).ready(function($){
    function parseColors(){
        var val = $('#winshirt_mockup_colors').val() || '';
        return val.split(/[,\s]+/).filter(Boolean);
    }

    function renderMockups(){
        var src = $('#winshirt_mockup_image_preview').attr('src');
        var colors = parseColors();
        var container = $('#winshirt_mockup_result');
        container.empty();
        if(!src){
            return;
        }
        colors.forEach(function(color){
            var canvas = $('<canvas class="winshirt-mockup-canvas"></canvas>')[0];
            var ctx = canvas.getContext('2d');
            var img = new Image();
            img.onload = function(){
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                ctx.globalCompositeOperation = 'source-in';
                ctx.fillStyle = color;
                ctx.fillRect(0, 0, canvas.width, canvas.height);
            };
            img.src = src;
            container.append(canvas);
        });
    }

    $('#winshirt_mockup_colors').on('input', renderMockups);
    $(document).on('winshirtImageSelected', renderMockups);
    renderMockups();
});
