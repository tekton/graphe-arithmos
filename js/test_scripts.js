/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var verse_tbl_row="";
var tblRow = "";

$(document).ready(function(){
	
    get_entry_data();
    get_verses_data();
    
    tblRow += "<tr>";
    
    tblRow += "<td><select name='book'>";
    var options = "";
    

    $.each(books, function(k, v) {
        //alert(k+" :: "+v);
        options += "<option value='"+k+"'>"+v+"</option>";
    });

    tblRow += options;
    tblRow += "</select></td>";
    tblRow += "<td><input type=\"text\" name=\"chapter\" size='3' /></td>"+
            "<td><input type=\"text\" name=\"v_start\" size='3' /></td>"+
            "<td><input type=\"text\" name=\"v_end\" size='3' /></td>"+
            "<td><span class=\"ui-icon ui-icon-circle-plus\"> </span></td>"+
            "</tr>";

    $(tblRow).appendTo("#verses_table tbody");

    $('body').click(function(event) {
        if ($(event.target).is('.ui-icon-circle-plus')) {

            var book = $(event.target).parent().parent().contents().find("select[name='book']").val();
            var chapter = $(event.target).parent().parent().contents().find("input[name='chapter']").val();
            var v_start = $(event.target).parent().parent().contents().find("input[name='v_start']").val();
            var v_end = $(event.target).parent().parent().contents().find("input[name='v_end']").val();

            alert(book + " :: " + chapter + " :: " + v_start + " :: " + v_end);

            $(tblRow).appendTo("#verses_table tbody");
            
            $(event.target).hide();
            
            $.post("json_post.php?id="+id+"&slot=verse", {"book": book, "chapter": chapter, "v_start": v_start,"v_end": v_end},
            function(data){
                get_verse_data(data);
            });
        }
    });

    

    $("#post_body").click(function(){
        var text = $('textarea#body_val').val();
        alert(text);
        $.post("json_post.php?id="+id+"&slot=body", {"body": text},
        function(){
            get_entry_data();
        });
    });

    $("#post_title").click(function(){
        var text = $('input#input_title').val();
        alert(text);
        $.post("json_post.php?id="+id+"&slot=title", {"title": text},
        function(){
            get_entry_data();
        });
    });

    $("#post_notes").click(function(){
        var text = $('textarea#notes_val').val();
        alert(text);
        $.post("json_post.php?id="+id+"&slot=notes", {"notes": text},
        function(){
            get_entry_data();
        });
    });
    
    function get_entry_data() {
        $.getJSON(
            "json.php?id="+id,
            function(data){
                $("#id").html(data.id);
                $("#title").html(data.title);
                $("#body").html(data.body);
                $("#notes").html(data.notes);
                    $('textarea#body_val').val(data.body);
                    $('textarea#notes_val').val(data.notes);
                    $('input#input_title').val(data.title);
            }
        );        
    }
 
     function get_verses_data() {
        //$("#verses_linked").html("");
        $.getJSON(
            "json.php?id="+id+"&type=verses",
            function(data){
                $.each(data, function(verse, vals) {
                    text = vals["book"]+" "+vals["chapter"]+":"+vals["v_start"]+"-"+vals["v_end"];
                    $("#verses_linked").append("<div class='verse'>"+text+"</div>");
                });
            }
        );        
    }
 
      function get_verse_data(v_id) {
        //$("#verses_linked").html("");
        $.getJSON(
            "json.php?id="+id+"&type=verse&v_id="+v_id,
            function(vals){
                
                    text = vals["book"]+" "+vals["chapter"]+":"+vals["v_start"]+"-"+vals["v_end"];
                    $("#verses_linked").append("<div class='verse'>"+text+"</div>");
                
            }
        );        
    }   
    
});

$.extend({
    urlParams: function(){
        var params = [], pair;
        var pairs = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        //alert(pairs);
        for(var i = 0; i < pairs.length; i++)
        {
            pair = pairs[i].split('=');
            params.push(pair[0]);
            params[pair[0]] = pair[1];
        }
        return params;
    }
});