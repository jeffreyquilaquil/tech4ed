<style media="screen">
  .tech_link:hover, .tech_link:visited, .tech_link:active, .tech_link:focus{
    text-decoration: none;
  }
  .tech_link{
    background: red;
  }
  .tech_div{
    height: 30%;
    width: 70%;
    margin-left: 15%;
    margin-top: 3%;
    background: rgba(0, 0, 0, 0.82);
    border-radius: 5px;
    line-height: 200px;
    text-align: center;
    color: white;
    box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.86);

  }
  .tech_div > p{
    font-size: 60px;
    font-weight: bold;index
    font-family: Arial;
  }

</style>
<a href="#" target="_blank" class='tech_link' onclick="event.preventDefault()" data-toggle="modal" data-target="#dostTech_modal">
  <div class='tech_div'>
    <p>DOST Technologies</p>
  </div>
</a>

<a href="#" target="_blank" class="tech_link" onclick="event.preventDefault()" data-toggle="modal" data-target="#vsuTech_modal">
  <div class="tech_div">
    <p>VSU - VICAARP Technology</p>
  </div>
</a>

<script src="technology/techList.js" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.headName span').text('Technology')
    $('.headName img').attr('src','images/clipart/technology.png')

    // For DOST Tech Main navigation
    let dataList = dataArr[0][0];
    for(let key in dataList){
      $('#dostTech_modal .main-nav ul').append('<li data-index="0,'+key+'"><i class="fa fa-folder-open"></i>'+dataList[key]+'</li>')
    }

    // For VSU Tech Main navigation
    dataList = dataArr[1][0];
    for(let key in dataList){
      $('#vsuTech_modal .main-nav ul').append('<li data-index="1,'+key+'"><i class="fa fa-folder-open"></i>'+dataList[key]+'</li>')
    }
  })

  var armNavDisplay = false;
  var link = null;
  $(document).on('click','.tech_modal li',function(){
    var parent = $(this).parents('.tech_modal');
    // get data attr "index" then split index for the corresponding index for JSON
    let dataIndex = $(this).data('index').toString().split(',')
    let modal = (dataIndex[0] === "0") ? '#dostTech_modal' : '#vsuTech_modal';

    if(dataIndex.length == 2){
      // clear secondary navigation everytime a main navigation is clicked
      $('.arm-nav ul').html('')
      $('.main-nav li').css('background','none')
      // Fetch data from dataArr by supplying the given index
      dataIndex[1] = parseInt(dataIndex[1])+1
      let dataList = dataArr[ dataIndex[0] ][ dataIndex[1] ];
      for(let key in dataList){
        let title = dataList[key]
        $(modal + ' .arm-nav ul').append('<li data-index="'+dataIndex[0]+','+dataIndex[1]+','+key+'"><i class="fa fa-file-pdf-o"></i> '+title+'</li>')
      }
    }
    if(dataIndex.length == 3){
      let parentDir = (dataIndex[0] === "0" ? ['dost_tech','#dostTech_modal'] : ['vsu_tech','#vsuTech_modal']);
      let filename = dataArr[ dataIndex[0] ][ dataIndex[1] ][ dataIndex[2]];
      link = 'technology/'+parentDir[0]+'/'+filename+'.pdf';

      $('.arm-nav li').css('background','none');
      $(parentDir[1]+' form').css('opacity','1')
      openLink( link, modal)
    }
    $(this).css('background','rgb(210, 210, 210)');
  })

  // Send PDF Technology through Email
  $('.btn_sendEmail').click(function(){
    var parent = $(this).parent();
    $(parent).children('img').css('display','inline')
    $.ajax({
      url:'spec_func.php',
      data:{
        'type' : 'emailSend',
        'emailAdd' : $('.input_sendEmail').val(),
        'file' : link
      }
    }).done(function(){
      $(parent).children('img').css('display','none')
      $(parent).children('span').css('display','inline')
    });
  })
</script>
