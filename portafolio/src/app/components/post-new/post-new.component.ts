import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';
import { UserService } from 'src/app/services/user.service';
import { Post } from 'src/app/models/post';
import { PostService } from '../../services/post.service';
import { error } from 'protractor';
import { global } from '../../services/global';

@Component({
  selector: 'app-post-new',
  templateUrl: './post-new.component.html',
  styleUrls: ['./post-new.component.css'],
  providers: [UserService, PostService]
})
export class PostNewComponent implements OnInit {
  public page_title: string;
  public identity;
  public token;
  public post: Post;
  public status;
  

  constructor(
    private _route: ActivatedRoute,
    private _router: Router,
    private _userService: UserService,
    private _postService: PostService
  ){
      this.page_title = 'Crear Post';
      this.identity = this._userService.getIdentity();
      this.token = this._userService.getToken();
     
  }

  ngOnInit() {
    console.log(this.identity);
    this.post = new Post(1, '', '', null);
    console.log(this.post);
  }

  onSubmit(form){
    //console.log(this.post);
    //console.log(this._postService.pruebas());
    this._postService.create(this.post).subscribe(
      response => {
        if(response.status == 'success'){
          this.post = response.post;
          this.status = 'success';
          this._router.navigate(['/crear-post']);
        }else{
          this.status = 'error'
        }
      },
      error => {  
        console.log(error);
        this.status = 'error';

      }
    );
  }

}

