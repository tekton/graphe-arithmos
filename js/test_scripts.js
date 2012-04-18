/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var verse_tbl_row="";

$(document).ready(function(){
	
    $.getJSON(
        "json.php?id=2",
        function(data){
            $("#id").append(data.id);
            $("#title").append(data.title);
            $("#body").append(data.body);
            $("#notes").append(data.notes);
                $('textarea#body_val').val(data.body);
                $('textarea#notes_val').val(data.notes);
                $('input#input_title').val(data.title);
        }
    );

    tblRow = "<tr>";
    
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

            var $book = $(event.target).parent().parent().contents().find("input[name='book']").val();
            var $chapter = $(event.target).parent().parent().contents().find("input[name='chapter']").val();
            var $v_start = $(event.target).parent().parent().contents().find("input[name='v_start']").val();
            var $v_end = $(event.target).parent().parent().contents().find("input[name='v_end']").val();

            alert($book + " :: " + $chapter + " :: " + $v_start + " :: " + $v_end);

            $(tblRow).appendTo("#verses_table tbody");
        }
    });

    });

    $("#post_body").click(function(){
    var text = $('textarea#body_val').val();
    alert(text);
    $.post("json_post.php?id=2&slot=body", { "body": text});
    });

    $("#post_title").click(function(){
    var text = $('input#input_title').val();
    alert(text);
    $.post("json_post.php?id=2&slot=title", { "title": text});
    });

    $("#post_notes").click(function(){
    var text = $('textarea#notes_val').val();
    alert(text);
    $.post("json_post.php?id=2&slot=notes", { "notes": text});
    });
    
    function get_books() {
        $.getJSON(
            "books.php",
            function(data){
                alert(data);
            }
        );
    }
    
    function set_verse_row() {
        
    }