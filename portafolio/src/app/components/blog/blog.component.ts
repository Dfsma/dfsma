import { Component, OnInit } from '@angular/core';
import { Post } from '../../models/post';
import { PostService } from '../../services/post.service';
import { global } from '../../services/global';

@Component({
  selector: 'app-blog',
  templateUrl: './blog.component.html',
  styleUrls: ['./blog.component.css'],
  providers: [PostService, PostService]
})
export class BlogComponent implements OnInit {
  
  public url;
  public posts: Array<Post>;


  constructor(
    private _postService: PostService

  ) { 
    this.url = global.url;
  }

  ngOnInit() {
    this.getPosts();
  }
  
  getPosts(){
    this._postService.getPosts().subscribe(
      response => {
        if(response.status == 'success'){
          this.posts = response.posts;
          console.log(this.posts);
        }else{

        }
      },
      error => {
        console.log(error);
      }
    );
  }
}
