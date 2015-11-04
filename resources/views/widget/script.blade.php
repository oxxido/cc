window.addEventListener("load", function(){
    var div = document.createElement("DIV");
    div.style.width="400px";
    div.style.height="500px";
    div.style.border="1px solid #ddd";
    var iframe = document.createElement("IFRAME");
    iframe.src="{{ url("widget/{$type}/iframe/{$product_uuid}") }}";
    iframe.style.border="0px";
    iframe.style.width="100%";
    iframe.style.height="100%";
    var root = document.getElementById("cc-widget-{{ $type }}-{{ $product_uuid }}");
    div.appendChild(iframe);
    root.parentNode.appendChild(div);
});