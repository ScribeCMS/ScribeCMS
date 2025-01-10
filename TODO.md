## Page CRUD

- Views
    - [x] Index
    - [x] Trash/Restore/Destroy
    - [x] Edit / Create
    - [ ] Enums
    - [ ] Components
- Actions
    - [x] Create Page
    - [x] Edit Page
    - [x] Trash
    - [x] Restore
    - [x] Destroy

## Post CRUD

- Views
    - [x] Index
    - [x] Trash/Restore/Destroy
    - [x] Edit / Create
    - [ ] Enums
    - [ ] Components

## Comment CRUD (admin)

- Views
    - [x] Index
    - [x] Trash/Restore/Destroy
    - [ ] Edit / Create
    - [ ] Enums
    - [ ] Components

## Users CRUD

- Views
    - [x] Index
    - [x] Edit / Create
    - [x] Delete
    - [x] Edit password
    - [x] Enums (roles)

Policies should be put in place for creating/editing/deleting users that are not your own. Presumably, Owner level users should be able to do anything, and managers should be able to add/edit/delete any users that are not Owners. Lower level roles should only be able to edit their own profile, nothing else.

## Login

- [x] Functioning login form
- [x] Styled login form
- [X] Log out
- [ ] Reset password
- [ ] Session management

## Permissions

- [x] Auth middleware for all admin views
- [ ] Policies for CRUD actions
- [ ] Roles? Groups? (start with Owner, add more as necessary)
- [ ] Other policies

## Themes

- [x] Routes -> Template hierarchy
- [x] Default theme
- [x] Components
- [ ] Admin UI?

## Tags / Labels / Collections

[Possible input UI/UX](https://www.youtube.com/watch?v=wQ7fN-1GrV0) for tags on post composition page. Ideally, we would use AlpineJS, but we may need Livewire to do dynamic search over large tag tables.

Input needs search, select, and add new (if tag text doesn't match existing tag).

## Databased indexes

A [good thread](https://x.com/mmartin_joo/status/1871199591510483219) on indexing. Might be helpful.

## Package extraction

## Admin Design

- [x] Functional design
- [ ] Redesign?

## Translations

- [ ] Create package translation file
- [ ] Can we do namespaced translation files? Do we need that?

## Editor

- [x] Textarea
- [x] Markdown?
- [ ] Basic TipTap (MIT) implementation

## Media

We can start simple. Basic upload via Laravel, or with something like [FilePond](https://pqina.nl/filepond/) (MIT), and process resizes with something like [Glide](https://glide.thephpleague.com/) (MIT). For performance, combine a real directory (or symlink to the cache dir) with a Laravel route. Process requests via routing, and generate the images into the real directory. Web server should serve the image if it exists, or generate it into place if it doesn't (for subsequent requests).

Potentional evolution to [client side image/media processing](https://pascalbirchler.com/client-side-media-processing-wordpress/) via [wasm-vips](https://github.com/kleisauke/wasm-vips) (MIT).

- [ ] Images
- [ ] Media management
- [ ] Upload from editor

## Feeds

- [ ] RSS and JSON feed for latest posts
- [ ] More feeds?

## Meta Tables

- [ ] Necessity?
- [ ] Post Metadata
- [ ] User Metadata
- [ ] Tag Metadata

## Plugins

- Managed via admin or composer?

## WordPress importer

- [ ] Views
- [ ] Controller
- [ ] Actions
