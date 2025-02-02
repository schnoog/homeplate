{include file='head.tpl'}    

       <section class="h-100 gradient-form" style="background-color: #eee;">
       <div class="container py-5 h-100">
         <div class="row d-flex justify-content-center align-items-center h-100">
           <div class="col-xl-10">
             <div class="card rounded-3 text-black">
               <div class="row g-0">
                 <div class="col-lg-6">
                   <div class="card-body p-md-5 mx-md-6">
     
                   <h2>{$msg}</h2>

     
                     <form method="post">
                       <p>Please login to your account</p>
     
                       <div data-mdb-input-init class="form-outline mb-4">
                         <input type="username" id="username" class="form-control" name="username"
                           placeholder="username" />
                         <label class="form-label" for="username">Username</label>
                       </div>
     
                       <div data-mdb-input-init class="form-outline mb-4">
                         <input type="password" id="password" class="form-control" name="password" />
                         <label class="form-label" for="password">Password</label>
                       </div>
     
                       <div class="text-center pt-1 mb-5 pb-1">
                         <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log
                           in</button>
                       </div>
     

     
                     </form>
     
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </section>




{include file='foot.tpl'} 