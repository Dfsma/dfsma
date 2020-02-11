//Import Necesarios
import { ModuleWithProviders } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

// Importar Componentes
import { AboutComponent } from './components/about/about.component';
import { BlogComponent } from './components/blog/blog.component';
import { PostDetailComponent } from './components/post-detail/post-detail.component';
import { LoginComponent } from './components/login/login.component';
import { PostNewComponent } from './components/post-new/post-new.component';

// Definir las rutas
const appRoutes: Routes = [
    {path: '', component: BlogComponent},
    {path: 'about', component: AboutComponent},
    {path: 'post/:id', component: PostDetailComponent },
    {path: 'login', component: LoginComponent},
    {path: 'logout/:sure', component: LoginComponent},
    {path: 'crear-post', component: PostNewComponent}
    
];

// Exportar Configuracion
export const appRoutingProviders: any[] = [];
export const routing: ModuleWithProviders = RouterModule.forRoot(appRoutes);