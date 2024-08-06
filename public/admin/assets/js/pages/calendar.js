!function(){const l=new bootstrap.Offcanvas("#calendar-add_edit_event"),d=new bootstrap.Modal("#calendar-modal");var r="",e=new Date,t=(e.getDate(),e.getMonth()),e=e.getFullYear(),a=new FullCalendar.Calendar(document.getElementById("calendar"),{headerToolbar:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek,timeGridDay,listMonth"},themeSystem:"bootstrap",initialDate:new Date(e,t,16),slotDuration:"00:10:00",navLinks:!0,height:"auto",droppable:!0,selectable:!0,selectMirror:!0,editable:!0,dayMaxEvents:!0,handleWindowResize:!0,select:function(e){var t=new Date(e.start),e=new Date(e.end);document.getElementById("pc-e-sdate").value=t.getFullYear()+"-"+o(t.getMonth()+1)+"-"+o(t.getDate()),document.getElementById("pc-e-edate").value=e.getFullYear()+"-"+o(e.getMonth()+1)+"-"+o(e.getDate()),document.getElementById("pc-e-title").value="",document.getElementById("pc-e-venue").value="",document.getElementById("pc-e-description").value="",document.getElementById("pc-e-type").value="",document.getElementById("pc-e-btn-text").innerHTML='<i class="align-text-bottom me-1 ti ti-calendar-plus"></i> Add',document.querySelector("#pc_event_add").setAttribute("data-pc-action","add"),l.show(),a.unselect()},eventClick:function(e){r=e.event;var e=e.event,t=void 0===e.title?"":e.title,n=void 0===e.extendedProps.description?"":e.extendedProps.description,a=null===e.start?"":c(e.start),i=null===e.end?"":" <i class='text-sm'>to</i> "+c(e.end),i=null===e.end?"":i,e=void 0===e.extendedProps.description?"":e.extendedProps.venue;document.querySelector(".calendar-modal-title").innerHTML=t,document.querySelector(".pc-event-title").innerHTML=t,document.querySelector(".pc-event-description").innerHTML=n,document.querySelector(".pc-event-date").innerHTML=a+i,document.querySelector(".pc-event-venue").innerHTML=e,d.show()},events:[{title:"All Day Event",start:new Date(e,t,1),allDay:!0,description:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.",venue:"City Town",className:"event-warning"},{title:"Long Event",start:new Date(e,t,7),end:new Date(e,t,10),allDay:!0,description:"It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",venue:"City Town",className:"event-primary"},{groupId:999,title:"Repeating Event",start:new Date(e,t,9,16,0),allDay:!1,description:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.",venue:"City Town",className:"event-danger"},{groupId:999,title:"Repeating Event",start:new Date(e,t,16,16,0),allDay:!1,description:"It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",venue:"City Town",className:"event-danger"},{title:"Conference",start:new Date(e,t,11),end:new Date(e,t,13),allDay:!0,description:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.",venue:"City Town",className:"event-info"},{title:"Meeting",start:new Date(e,t,12,10,30),end:new Date(e,t,12,12,30),allDay:!1,description:"It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",venue:"City Town",className:"event-danger"},{title:"Lunch",start:new Date(e,t,12,12,30),allDay:!1,description:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.",venue:"City Town",className:"event-success"},{title:"Meeting",start:new Date(e,t,14,14,30),allDay:!1,description:"It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",venue:"City Town",className:"event-warning"},{title:"Happy Hour",start:new Date(e,t,14,17,30),allDay:!1,description:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.",venue:"City Town",className:"event-info"},{title:"Dinner",start:new Date(e,t,15,20,0),allDay:!1,description:"It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",venue:"City Town",className:"event-primary"},{title:"Birthday Party",start:new Date(e,t,13,0,0),allDay:!1,description:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.",venue:"City Town",className:"event-success"},{title:"Click for Google",url:"http://google.com/",allDay:!0,description:"It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",venue:"City Town",start:new Date(e,t,28)}]}),e=(a.render(),document.addEventListener("DOMContentLoaded",function(){for(var e=document.querySelectorAll(".fc-toolbar-chunk"),t=0;t<e.length;t++){var n=e[t];n.children[0].classList.remove("btn-group"),n.children[0].classList.add("d-inline-flex")}}),document.querySelector("#pc_event_remove")),i=(e&&e.addEventListener("click",function(){const t=Swal.mixin({customClass:{confirmButton:"btn btn-light-success",cancelButton:"btn btn-light-danger"},buttonsStyling:!1});t.fire({title:"Are you sure?",text:"you want to delete this event?",icon:"warning",showCancelButton:!0,confirmButtonText:"Yes, delete it!",cancelButtonText:"No, cancel!",reverseButtons:!0}).then(e=>{e.isConfirmed?(r.remove(),d.hide(),t.fire("Deleted!","Your Event has been deleted.","success")):e.dismiss===Swal.DismissReason.cancel&&t.fire("Cancelled","Your Event data is safe.","error")})}),document.querySelector("#pc_event_add")),t=(i&&i.addEventListener("click",function(){var e=null,t=null===document.getElementById("pc-e-sdate").value?"":document.getElementById("pc-e-sdate").value,n=null===document.getElementById("pc-e-edate").value?"":document.getElementById("pc-e-edate").value;""==!n&&(e=new Date(n)),a.addEvent({title:document.getElementById("pc-e-title").value,start:new Date(t),end:e,allDay:!0,description:document.getElementById("pc-e-description").value,venue:document.getElementById("pc-e-venue").value,className:document.getElementById("pc-e-type").value}),"add"==i.getAttribute("data-pc-action")?Swal.fire({customClass:{confirmButton:"btn btn-light-primary"},buttonsStyling:!1,icon:"success",title:"Success",text:"Event added successfully"}):(r.remove(),document.getElementById("pc-e-btn-text").innerHTML='<i class="align-text-bottom me-1 ti ti-calendar-plus"></i> Add',document.querySelector("#pc_event_add").setAttribute("data-pc-action","add"),Swal.fire({customClass:{confirmButton:"btn btn-light-primary"},buttonsStyling:!1,icon:"success",title:"Success",text:"Event Updated successfully"})),l.hide()}),document.querySelector("#pc_event_edit"));function o(e){return e<10?"0"+e:e}function c(e){var e=new Date(e),t=""+["January","February","March","April","May","June","July","August","September","October","November","December"][e.getMonth()],n=""+e.getDate(),e=e.getFullYear();return t.length<2&&(t="0"+t),[(n=n.length<2?"0"+n:n)+" "+t,e].join(",")}t&&t.addEventListener("click",function(){var e=void 0===r.title?"":r.title,t=void 0===r.extendedProps.description?"":r.extendedProps.description,n=null===r.start?"":c(r.start),a=null===r.end?"":" <i class='text-sm'>to</i> "+c(r.end),a=null===r.end?"":a,i=void 0===r.extendedProps.description?"":r.extendedProps.venue,s=void 0===r.classNames[0]?"":r.classNames[0],e=(document.getElementById("pc-e-title").value=e,document.getElementById("pc-e-venue").value=i,document.getElementById("pc-e-description").value=t,document.getElementById("pc-e-type").value=s,new Date(n)),i=new Date(a);document.getElementById("pc-e-sdate").value=e.getFullYear()+"-"+o(e.getMonth()+1)+"-"+o(e.getDate()),document.getElementById("pc-e-edate").value=i.getFullYear()+"-"+o(i.getMonth()+1)+"-"+o(i.getDate()),document.getElementById("pc-e-btn-text").innerHTML='<i class="align-text-bottom me-1 ti ti-calendar-stats"></i> Update',document.querySelector("#pc_event_add").setAttribute("data-pc-action","edit"),d.hide(),l.show()})}();