
function setupGrid(aGender) {
    var ag = new athleteGrid(aGender);

    ag.addContent();
    ag.setAthletes();
    ag.setInitialAthlete(0);

    $("body").on("click",".grid_image",function(){

        var name = $(this).attr("name");
        ag.switchSelectedAthlete(name);

    });
}

var athleteGrid = function(gender){
    this.gender = gender;
    this.male_athlete_names = ["Joey","Brandon","Lazar","Jonathan"];
    this.female_athlete_names = ["Jessica","Ainsley","Andreia","Bella","Britt"];
    this.description_grid = {
        ainsley:{
            title:"Ainsley likes to take...",
            testimonial:"BCAA+Glutamine Pre and post workout with TONER and BURNERMAX to stay lean and curvy. ",
        },
        alex:{
            title:"Alex stays ripped and aesthetic with",
            testimonial:"BURNERMAX pre-cardio, CREATINE before he lifts, and PROTEIN post workout.",
        },
        andreia:{
            title:"Andreia keeps her body strong and sexy by",
            testimonial:"staying consistent with weights and using TONER pre-workout and BCAA+Glutamine all day long.",
        },
        bella:{
            title:"Bella Loves to have...",
            testimonial:"Shredz PROTEIN pancakes after her morning cardio!",
        },
        brandon:{
            title:"Brandon stays cut and jacked",
            testimonial:"with fasted cardio and BCAA+Glutamine, weights, and Shredz protein shakes!",
        },
        britt:{
            title:"Brittany loves to stay in shape by...",
            testimonial:"making delicious BCAA ice pops, taking BURNERMAX, and ending her weight training with a PROTEIN smoothie.",
        },
        jessica:{
            title:"Jessica makes her fitness fun by",
            testimonial:"starting her day with a BCAA+Glutamine fruit smoothie before morning cardio with a serving of BURNERMAX.",
        },
        joey:{
            title:"Joey stays lean and massive",
            testimonial:"by taking PROTEIN between meals, CREATINE pre-workout, and BCAA+Glutamine intra-workout. ",
        },
        jonathan:{
            title:"Jonathan stays athletic and aesthetic with",
            testimonial:"BURNERMAX pre-cardio, CREATINE before he lifts, and PROTEIN post workout.",
        },
        lazar:{
            title:"Lazar keeps his abs tight and separated",
            testimonial:"with a clean diet, cardio and BURNERMAX.",
        },
        natalie:{
            title:"Natalie likes to take...",
            testimonial:"BCAA+Glutamine Pre and post workout with TONER and BURNERMAX to stay lean and fit.",
        }
    };
    this.athlete_grid_image = new Object();
    this.athlete_selected_image = new Object();
    this.athlete_background = new Object();
    this.used_array = new Array();
    this.selected_suffix = "selectedathlete";
    this.grid_suffix="thumbnail";
    this.background_suffix="background";
    this.container_div_id = "athlete_testimonial";
    this.selected_icon_div ="left_main_display_icon";
    this.athlete_testimonial="athlete_testimonial_holder";
    this.grid_class_suffix ="grid_suffix";


    //add all the content to the arrays and objects
    this.addContent = function()
    {

        var gender =  this.gender;
        var array;
        var self = this;
        if (gender == "male")
        {
            array = this.male_athlete_names;
            self.used_array = this.male_athlete_names;

        }
        else
        {
            array = this.female_athlete_names;
            self.used_array = this.female_athlete_names;
        }


        for(var i = 0;i<array.length;i++)
        {
         var name = array[i];

        }


    }


    this.setAthletes = function()
    {
        var array = this.used_array;
        $(".right_grid_images").html('');
      for(var i = 0;i<array.length;i++)
        {
            var name = array[i];
            var self = this;

            this.prefix = '/images/endorsements/';
            this.athlete_selected_image[name] = this.prefix + name + "/" + self.selected_suffix;
            this.athlete_grid_image[name] = this.prefix + name + "/" + self.grid_suffix;
            this.athlete_background[name] = this.prefix + name + "/" + self.background_suffix;

            $(".right_grid_images").append("<div name='"+name+"' id='"+name+self.grid_class_suffix+"' class='grid_image box'><img src='"+ this.athlete_grid_image[name]+".jpg'/></div>");

            preloadImage(this.athlete_background[name]+".jpg");
            preloadImage(this.athlete_selected_image[name]+".jpg");
        }

    }

    this.setInitialAthlete = function(index)
    {
        var self = this;
        var name = this.used_array[index];

         self.switchSelectedAthlete(name);

    }


       //switch the selected image back ground high light the icon and fill in the testmonial
    this.switchSelectedAthlete = function(name)
    {
        $(".active_athlete").removeClass("active_athlete");

        var self = this;
         var div_to_highlight = $("#"+name+self.grid_class_suffix);
         div_to_highlight.addClass("active_athlete");
        $("#"+self.selected_icon_div).html("<img src='"+self.athlete_selected_image[name] +".jpg'/>");
        $("#"+self.container_div_id).css({
            "background-image":"url("+self.athlete_background[name]+".jpg)"
        });

        var info =   this.description_grid[name.toLowerCase()];

        var title = info.title;
        var desc = info.testimonial;

        $(".athlete_testimonial_paragraph").html(desc);
        $(".athlete_testimonial_title").html(title);
    }


}



function preloadImage(link) {
  //  for (var i = 0; i < array.length; i++)
  //  {
     //   var link = array[i];
        var im = new Image();
        im.onload = function(){

        }

        im.src = link;

  //  }

}