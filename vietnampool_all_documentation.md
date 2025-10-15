# vietnampool

## Project Description
A Laravel PHP project on billiards tournament organization and management system in Vietnam. There are 3 types of accounts: administrator accounts, functional organizational unit accounts, and player accounts. The administrator account has the following functions: account management, tournament management. Functional unit accounts have the following functions: add, edit, delete entertainment; Tournament management (tournament information, participating players, competition diagram). Player accounts have the following functions: viewing information, participating in tournaments. The ranking system calculates points for participating players to save the tournaments they have participated in, prizes, and money received. News page updates the latest news about billiards

## Product Requirements Document
Product Requirements Document (PRD)

1. Introduction

This document outlines the product requirements for "vietnampool", a Laravel PHP-based web application designed for organizing and managing billiards tournaments in Vietnam. The system will cater to administrators, functional organizational units responsible for tournament operations, and individual player accounts, providing a comprehensive platform for tournament administration, player participation, ranking, and news dissemination.

2. Product Goals

The primary goals of the vietnampool system are:
*   To provide a centralized and efficient platform for organizing and managing billiards tournaments across Vietnam.
*   To accurately store and maintain the match history and performance data of amateur players.
*   To implement a robust and fair ranking system based on player achievements.
*   To streamline tournament operations, including player registration, bracket generation, and results management.
*   To offer a user-friendly experience for all account types, accessible across various devices.
*   To serve as a reliable source for billiards-related news and updates, particularly concerning professional tournaments.

3. Target Audience

The system is designed for the following target groups:
*   **Amateur Billiards Players**: Individuals who participate in local billiards tournaments and wish to track their performance, ranking, and tournament history.
*   **Billiards Tournament Organizers (Functional Organizational Units)**: Entities responsible for setting up, managing, and executing tournaments, including player registration, bracket management, and prize distribution.
*   **System Administrators**: Individuals responsible for overall system maintenance, user account management, and content moderation.
*   **Billiards Enthusiasts**: Users interested in staying updated with the latest news and information from the billiards world, including professional tournaments.

The system specifically addresses the challenges of accurately storing amateur player match history, ensuring accurate ranking, and providing professional tournament management with an automated bracket generation system.

4. User Roles and Permissions

The system will support three distinct user roles, each with specific functionalities:

4.1. Administrator Account
*   **Account Management**: Create, edit, suspend, and delete user accounts (including FOU and Player accounts).
*   **Tournament Management Oversight**: General oversight of all tournaments within the system, potentially approving FOU-created tournaments or managing system-wide tournament settings.
*   **News Content Management**: Create, edit, and publish news articles for the news page, including the ability to embed images and videos.
*   **System Configuration**: Manage core system settings and parameters.

4.2. Functional Organizational Unit (FOU) Account
*   **Tournament Creation**: Create new tournaments with the following details:
    *   Tournament Name
    *   Category (e.g., 9-ball singles, 9-ball doubles, 10-ball singles, 10-ball doubles, 8-ball singles, 8-ball doubles)
    *   Number of Participants (up to 64)
    *   Start Time
    *   Venue
    *   Entry Fee
    *   Prize Amounts (Champion, Runner-up, Two Third-place prizes)
*   **Tournament Management**:
    *   Edit and delete existing tournaments (within specified constraints, e.g., before registration closes).
    *   Manage participating players (registration, withdrawal).
    *   Generate and manage the competition diagram (bracket).
    *   Input and update match results.
    *   Update prize winners and the prize money awarded to players after each tournament, which directly feeds into the ranking system.
*   **Entertainment Management (Clarification)**: The FOU account's "entertainment management" refers specifically to the organization and management of tournaments, not broader entertainment entities.

4.3. Player Account
*   **Information Viewing**: View details of upcoming, ongoing, and past tournaments.
*   **Tournament Participation**: Register for available tournaments.
*   **Match History**: Access their personal match history, including past tournament results.
*   **Ranking Information**: View their current ranking based on the system's ranking logic.
*   **News Viewing**: Browse the latest billiards news.

5. Key Features

5.1. User Authentication and Authorization
*   Secure user registration and login for all account types.
*   Role-based access control ensuring users can only access permitted functionalities.

5.2. Account Management (Administrator)
*   Dashboard for an overview of user accounts and system status.
*   Tools for managing user profiles, roles, and statuses.

5.3. Tournament Management (FOU & Administrator)
*   **Tournament Creation & Editing**: Comprehensive form for FOU to create and modify tournament details (name, category, participants, schedule, venue, fees, prizes).
*   **Automated Bracket Generation**:
    *   The system will automatically generate a double-elimination bracket based on the number of participants.
    *   **Double-Elimination Logic**:
        *   **Round 1**: Players are divided into two brackets: winners and losers.
        *   **Round 2 (Winners Bracket)**: Players who won in Round 1 compete against each other. Winners of this round advance directly to the knockout stage. Losers from this bracket proceed to play against winners from the Losers Bracket in Round 3.
        *   **Round 2 (Losers Bracket)**: Players who lost in Round 1 compete against each other. Winners from this bracket proceed to play against losers from the Winners Bracket in Round 3.
        *   **Round 3**: Losers from the Winners Bracket Round 2 play against the winners from the Losers Bracket Round 2. Winners of Round 3 proceed to the knockout stage (final phase).
        *   **Knockout Stage (Final Phase)**: Half of the remaining players compete in single-elimination matches until the final winner is determined.
*   **Participant Management**:
    *   Player registration for tournaments.
    *   Viewing and managing registered players.
*   **Match Results Input**: FOU accounts can input and update results for individual matches within a tournament.
*   **Prize Winner Update**: FOU accounts can designate prize winners (champion, runner-up, two third-place) and the prize money awarded after each tournament. This action triggers the update for the ranking system.

5.4. Player Features
*   **Tournament Browsing**: Players can view a list of all tournaments, filter by status (upcoming, ongoing, completed), category, etc.
*   **Tournament Participation**: A clear interface for players to register for available tournaments.
*   **Personal Dashboard**: A personalized view showing registered tournaments, upcoming matches, and a summary of their performance.
*   **Match History**: Detailed records of all matches played, including results, opponents, and tournament context.

5.5. Ranking System
*   **Ranking Logic**: The ranking system is primarily based on the total prize money earned by each player across all tournaments they have participated in.
*   **Points Calculation**: The system will automatically calculate and update a player's ranking points based on the prize money updated by the FOU after each tournament.
*   **Ranking Display**: A public-facing ranking page displaying players sorted by their total prize money, potentially with filters (e.g., by category, time period).
*   **Player Profiles**: Each player profile will display their accumulated prize money, tournaments participated in, and individual achievements.

5.6. News Page
*   **Content Management (Administrator)**:
    *   Admin interface to create, edit, and delete news posts.
    *   Ability to include rich text, embedded images, and embedded videos within news articles.
*   **News Display (Public/Players)**:
    *   A dedicated section displaying the latest news about billiards, with a focus on professional tournaments.
    *   News articles will be presented with clear titles, content, and media.

6. User Interface / User Experience (UI/UX) Guidelines

*   **Design Theme**: Modern sports style, emphasizing dynamism and clarity.
*   **Responsiveness**: The UI/UX must be fully responsive and adapt seamlessly to various screen sizes, including mobile devices (smartphones and tablets).
*   **Color Scheme**: The primary color theme will be "#21324C". Accent colors will be chosen to complement this primary color while maintaining readability and visual appeal.
*   **User-Friendly**: Intuitive navigation, clear call-to-actions, and minimal cognitive load for all user types.
*   **Accessibility**: Adherence to basic accessibility standards for a broad user base.

7. Performance and Scalability

*   **Tournament Capacity**: The system must efficiently manage tournaments with up to 64 participants.
*   **Concurrent Users**: The system is expected to support up to 500 concurrent users within the next 1 to 3 years without significant performance degradation. This includes simultaneous browsing, registration, and data entry.
*   **Data Volume**: The system should be capable of storing a growing volume of player data, tournament history, and news content without performance bottlenecks.

8. Technical Environment (Implied)

*   **Development Framework**: Laravel PHP.

9. Data Security and Privacy Needs

While no specific integration requirements or unique data security/privacy needs have been identified beyond standard best practices, the system will implement:
*   Secure password storage (hashing).
*   Protection against common web vulnerabilities (e.g., SQL injection, XSS).
*   Role-based access control to prevent unauthorized data access.
*   Standard data backup procedures.

10. Constraints and Assumptions

*   The scope of "functional unit entertainment" is strictly limited to tournament organization and management within the system.
*   The system will not handle payment gateway integrations for entry fees or prize payouts directly; these will be managed offline by the FOU, with the system only recording the prize money awarded.
*   User accounts are assumed to be unique based on email or a designated user ID.
*   The automated bracket generation will adhere strictly to the described double-elimination format.
*   No specific external integrations (APIs, third-party services) are required at this stage.

## Technology Stack
TECHSTACK

This document outlines the recommended technology stack for the "vietnampool" project, a Laravel PHP-based system for billiards tournament organization and management in Vietnam. The selections are driven by the project's functional requirements, performance expectations, UI/UX guidelines, and the need for a robust, scalable, and maintainable application.

1.  **Core Technologies**

    *   **Backend Framework: Laravel (PHP)**
        *   **Justification**: As explicitly stated in the project description, Laravel is the chosen backend framework. It provides a highly productive and elegant development experience, crucial for rapid development of the complex tournament management logic, diverse user roles (administrator, functional organizational unit, player), and ranking system. Its robust feature set includes built-in authentication, database ORM (Eloquent), routing, and a powerful queue system, which are essential for managing tournament registrations, result processing, and potentially background ranking calculations. Laravel's security features also contribute to a secure application environment.

    *   **Programming Language: PHP**
        *   **Justification**: The foundational language for the Laravel framework. PHP offers a mature and widely adopted environment for web development, with extensive community support and a vast ecosystem of libraries and tools that complement Laravel. Its performance characteristics are well-suited for the project's anticipated user load and data processing needs.

    *   **Database: MySQL**
        *   **Justification**: A reliable, open-source relational database management system. MySQL is an excellent choice for storing structured data such as player profiles, tournament details (name, category, participants, schedule, venue, fees, prizes), match results, and the intricate ranking points (based on total prize money earned). Its proven stability, scalability, and performance are crucial for handling up to 64 participants per tournament and up to 500 concurrent users within the projected timeline. Its widespread adoption also ensures ample support and tooling.

    *   **Frontend Frameworks/Libraries: Inertia.js with Vue.js**
        *   **Justification**: To meet the demand for a "modern sports style" and a "user-friendly UI/UX that adapts seamlessly to mobile devices," a powerful JavaScript frontend framework is essential. Inertia.js allows building a Single Page Application (SPA) experience using server-side routing and controllers (Laravel) without the complexity of a separate API layer. This provides a highly integrated full-stack development experience. Vue.js, a progressive JavaScript framework, is recommended for its reactivity, component-based architecture, and ease of integration with Inertia.js. It will be pivotal for developing dynamic and interactive components, especially the automatic, visual double-elimination bracket system, player dashboards, and interactive news feeds.

    *   **Styling Framework: Tailwind CSS**
        *   **Justification**: A utility-first CSS framework that allows for rapid development of custom designs directly in the markup. Tailwind CSS is highly flexible and will facilitate the creation of the "modern sports style" UI/UX, ensuring full responsiveness across all devices. Its ease of customization makes it straightforward to implement the primary color theme of "#21324C" and maintain a consistent brand identity throughout the application.

    *   **Web Server: Nginx**
        *   **Justification**: Nginx is a high-performance HTTP server and reverse proxy. It is highly efficient at handling concurrent connections, making it an ideal choice for serving the "vietnampool" application, especially with expectations of up to 500 concurrent users. Nginx works seamlessly with PHP-FPM (FastCGI Process Manager) to deliver optimal performance and resource utilization.

2.  **Development & Operations Tools**

    *   **Version Control: Git**
        *   **Justification**: The industry standard for distributed version control. Git will be used for collaborative development, tracking all code changes, managing branches for features and bug fixes, and ensuring code integrity and a streamlined development workflow.

    *   **Containerization: Docker**
        *   **Justification**: Docker will be used to containerize the application and its dependencies (PHP, Nginx, MySQL, Redis). This ensures consistent development, testing, and production environments, simplifies setup for new developers, prevents "it works on my machine" issues, and streamlines deployment processes. Docker Compose will be utilized for orchestrating multi-container applications during development.

3.  **Key Libraries & Components**

    *   **Authentication & Authorization: Laravel Breeze / Jetstream**
        *   **Justification**: Leveraging Laravel's official authentication scaffolding, Breeze or Jetstream (with Inertia.js + Vue.js stack) provides a robust and secure foundation for managing the three distinct account types: administrator, functional organizational unit, and player. This includes secure registration, login, password management, and role-based access control to ensure users only access their permitted functionalities.

    *   **File Storage: Laravel's Filesystem (Flysystem)**
        *   **Justification**: For managing uploaded content on the news page, including embedded images and videos. Laravel's filesystem abstraction (powered by Flysystem) allows for seamless integration with various storage drivers (e.g., local disk for development, S3 or other cloud storage for production), providing flexibility and scalability for media assets.

    *   **Tournament Bracket Management: Custom Laravel Logic & Vue.js Component**
        *   **Justification**: The core functionality of automatically generating and managing double-elimination tournament brackets requires significant custom development.
            *   **Backend (Laravel)**: Dedicated services and models will handle the complex logic of player seeding, round progression, match scheduling, result updates (by functional units), and overall tournament state management according to the double-elimination format.
            *   **Frontend (Vue.js)**: A highly interactive Vue.js component will be developed to visually represent the dynamic bracket, allowing functional units to easily update match outcomes and players to view their progress, upcoming matches, and the overall tournament flow. This component will be critical for providing a "user-friendly UI/UX" for this complex feature.

    *   **Caching: Redis**
        *   **Justification**: To enhance application performance and scalability, especially for frequently accessed data like player rankings, tournament listings, and news articles, Redis will be employed as an in-memory data store and cache. This reduces database load and speeds up data retrieval, crucial for maintaining responsiveness with up to 500 concurrent users. Redis can also serve as a message broker for future real-time features if needed.

4.  **Performance & Scalability Considerations**

    The chosen stack is well-suited to meet the performance and scalability expectations:
    *   **Up to 64 participants per tournament**: The database schema and Laravel's ORM are designed to efficiently handle this level of data per tournament instance.
    *   **Up to 500 concurrent users**: Nginx, PHP-FPM, MySQL, and Redis caching provide a robust foundation. Careful database indexing, optimized queries, and efficient caching strategies will be implemented to ensure high performance under load.
    *   **Responsive UI**: Inertia.js with Vue.js and Tailwind CSS ensures a fast, client-side rendered experience that adapts well to various devices, minimizing server-side rendering latency and improving perceived performance.

5.  **User Interface & Experience**

    *   The combination of Vue.js for interactivity, Inertia.js for seamless SPA experience, and Tailwind CSS for rapid, custom styling will ensure the application adheres to the "modern sports style" and "user-friendly UI/UX" guidelines.
    *   The use of Tailwind CSS will specifically facilitate the implementation of the primary color theme "#21324C" and ensure a consistent, mobile-adaptive design across all sections, including the complex tournament bracket.

## Project Structure
PROJECT STRUCTURE

This document outlines the detailed file and folder organization for the vietnampool project, a Laravel PHP application. It describes the purpose of each directory and key files, reflecting the project's functional requirements and technical environment.

**1. Root Directory**

*   **`.env`**: (File) Environment configuration variables specific to the deployment, such as database credentials, API keys, and application URL. Not committed to version control.
*   **`.env.example`**: (File) A template for the `.env` file, showing all necessary environment variables without their values.
*   **`artisan`**: (File) The command-line interface for Laravel, used to execute various tasks like migrations, seeding, and custom commands.
*   **`composer.json`**: (File) Defines the project's PHP dependencies and scripts for Composer, the PHP package manager.
*   **`composer.lock`**: (File) Records the exact versions of all project dependencies to ensure consistent installations across environments.
*   **`package.json`**: (File) Defines Node.js dependencies and scripts for npm/Yarn, used for frontend asset compilation.
*   **`webpack.mix.js`**: (File) Configuration file for Laravel Mix, automating frontend asset compilation (Sass, JavaScript).
*   **`README.md`**: (File) General project information, setup instructions, and deployment guidelines.
*   **`storage/`**: (Directory) Stores various files generated by the framework, including logs, session data, cache files, and user-uploaded content.
    *   **`app/`**: Application-specific files.
        *   **`public/`**: Stores public files that are user-uploaded, such as news images and profile avatars. This directory is symlinked to `public/storage`.
            *   **`news_images/`**: Stores images embedded in news articles.
            *   **`profile_avatars/`**: Stores user profile pictures.
        *   **`_temp/`**: (Optional) Temporary files, e.g., during complex bracket generation or bulk data processing.
    *   **`framework/`**: Laravel's framework-generated files.
        *   **`cache/`**: Application cache files.
        *   **`sessions/`**: File-based session data.
        *   **`views/`**: Compiled Blade template files.
    *   **`logs/`**: Application log files, typically `laravel.log`.
*   **`vendor/`**: (Directory) Contains all third-party PHP libraries installed via Composer. Not committed to version control.

**2. `app/` Directory**

This directory holds the core code of the application, including models, controllers, services, and other essential classes.

*   **`Console/`**: Contains custom Artisan commands.
    *   **`Commands/`**:
        *   **`UpdatePlayerRanks.php`**: Artisan command to trigger a recalculation and update of player rankings.
        *   **`GenerateTournamentBrackets.php`**: Artisan command for generating complex brackets, potentially in the background.
*   **`Exceptions/`**: Contains custom exception classes and the exception handler.
    *   **`Handler.php`**: Central exception handling for the application.
*   **`Http/`**: Contains HTTP-related classes like controllers, middleware, and form requests.
    *   **`Controllers/`**: Manages HTTP requests and responses.
        *   **`Admin/`**: Controllers for administrator-specific functionalities.
            *   **`AccountController.php`**: Manages user accounts (create, edit, delete) for all roles.
            *   **`TournamentController.php`**: Manages all tournaments (overview, moderation, advanced settings).
            *   **`NewsController.php`**: Manages news articles (create, edit, delete, publish).
        *   **`Organizer/`**: Controllers for functional organizational unit functionalities.
            *   **`TournamentController.php`**: Manages specific tournaments (create, edit tournament info, manage participants, update match results, manage prizes).
            *   **`BracketController.php`**: Handles the generation and management of tournament brackets.
            *   **`PrizeController.php`**: Manages prize distribution and updates for tournaments.
        *   **`Player/`**: Controllers for player-specific functionalities.
            *   **`TournamentController.php`**: Allows players to view available tournaments and participate.
            *   **`ProfileController.php`**: Manages player's personal profile and past tournament history.
            *   **`RankingController.php`**: Displays global player rankings.
        *   **`Auth/`**: Standard Laravel authentication controllers (Login, Register, Forgot Password, Reset Password).
        *   **`HomeController.php`**: Controller for the main dashboard or landing page after login.
        *   **`NewsController.php`**: Controller for public viewing of news articles.
    *   **`Middleware/`**: Custom middleware for request filtering and authorization.
        *   **`AdminMiddleware.php`**: Ensures only administrators can access certain routes.
        *   **`OrganizerMiddleware.php`**: Ensures only organizers can access certain routes.
        *   **`RoleMiddleware.php`**: Generic role-based access control.
    *   **`Requests/`**: Form request classes for validation.
        *   **`Admin/`**: Validation for admin-specific forms.
            *   **`CreateUserRequest.php`**: Validates creation of new user accounts.
            *   **`UpdateUserRequest.php`**: Validates updates to user accounts.
            *   **`StoreNewsArticleRequest.php`**: Validates news article creation.
            *   **`UpdateNewsArticleRequest.php`**: Validates news article updates.
        *   **`Organizer/`**: Validation for organizer-specific forms.
            *   **`StoreTournamentRequest.php`**: Validates new tournament creation.
            *   **`UpdateTournamentRequest.php`**: Validates tournament information updates.
            *   **`UpdateMatchResultRequest.php`**: Validates match result submissions.
            *   **`UpdatePrizeWinnersRequest.php`**: Validates prize winner updates.
        *   **`Player/`**: Validation for player-specific forms.
            *   **`JoinTournamentRequest.php`**: Validates a player joining a tournament.
            *   **`UpdateProfileRequest.php`**: Validates player profile updates.
*   **`Models/`**: Eloquent models representing the application's database tables.
    *   **`User.php`**: Represents a user, including `admin`, `organizer`, and `player` roles.
    *   **`Tournament.php`**: Represents a billiards tournament, containing all its details.
    *   **`Category.php`**: Defines tournament categories (e.g., "9-ball singles", "10-ball doubles").
    *   **`Venue.php`**: Represents a tournament location or venue.
    *   **`Participant.php`**: Represents a player's participation in a specific tournament (pivot table between User and Tournament).
    *   **`Match.php`**: Represents an individual match within a tournament's bracket.
    *   **`BracketNode.php`**: (Optional, for highly complex bracket structures) Represents a node in the double-elimination bracket tree.
    *   **`NewsArticle.php`**: Represents a news post, including content, images, and videos.
    *   **`Prize.php`**: Records the prize details awarded to a player in a specific tournament.
    *   **`PlayerRanking.php`**: Stores pre-calculated player rankings based on total prize money.
*   **`Providers/`**: Service providers for bootstrapping services, registering bindings, and event listeners.
    *   **`AuthServiceProvider.php`**: Registers policies for authorization.
    *   **`AppServiceProvider.php`**: General application service registrations.
    *   **`RouteServiceProvider.php`**: Defines route loading logic.
*   **`Services/`**: Contains business logic that doesn't fit directly into models or controllers, promoting reusability and separation of concerns.
    *   **`TournamentBracketService.php`**: Handles the complex logic of generating, updating, and managing double-elimination tournament brackets.
    *   **`RankingService.php`**: Manages the calculation and update of player rankings based on prize money earned.
    *   **`TournamentParticipantService.php`**: Manages player participation, registration, and withdrawal from tournaments.
    *   **`MatchOutcomeService.php`**: Handles the progression of players through the bracket based on match results.
*   **`Traits/`**: Reusable code blocks for models or other classes.
    *   **`HasRoles.php`**: (Optional) Trait for managing user roles.

**3. `bootstrap/` Directory**

Contains framework bootstrap files.

*   **`app.php`**: (File) Initializes the Laravel application.
*   **`cache/`**: (Directory) Stores framework bootstrap files for improved performance.

**4. `config/` Directory**

Contains all application configuration files.

*   **`app.php`**: Core application configuration.
*   **`auth.php`**: Authentication configuration (guards, providers, passwords).
*   **`database.php`**: Database connection settings.
*   **`filesystems.php`**: File storage configurations.
*   **`mail.php`**: Mailer configuration.
*   **`services.php`**: Configuration for external services.
*   **`vietnampool.php`**: Custom configuration for project-specific settings, such as tournament categories, user roles mapping, or specific prize structures.

**5. `database/` Directory**

Contains database migration, seeder, and factory files.

*   **`factories/`**: Model factories for generating fake data for testing and seeding.
    *   **`UserFactory.php`**: Factory for `User` model.
    *   **`TournamentFactory.php`**: Factory for `Tournament` model.
    *   **`NewsArticleFactory.php`**: Factory for `NewsArticle` model.
*   **`migrations/`**: Database migration files that define the schema of the database.
    *   **`xxxx_xx_xx_xxxxxx_create_users_table.php`**: Creates the `users` table, including `name`, `email`, `password`, and `role` (admin, organizer, player).
    *   **`xxxx_xx_xx_xxxxxx_create_categories_table.php`**: Creates the `categories` table (e.g., "9-ball singles").
    *   **`xxxx_xx_xx_xxxxxx_create_venues_table.php`**: Creates the `venues` table for tournament locations.
    *   **`xxxx_xx_xx_xxxxxx_create_tournaments_table.php`**: Creates the `tournaments` table, including name, category, capacity, start time, venue, entry fee, and prize amounts.
    *   **`xxxx_xx_xx_xxxxxx_create_tournament_participants_table.php`**: Creates the `tournament_participants` pivot table to link users to tournaments they participate in.
    *   **`xxxx_xx_xx_xxxxxx_create_matches_table.php`**: Creates the `matches` table for individual matches within a tournament bracket (tournament_id, round, winner_id, loser_id, bracket_type, status, etc.).
    *   **`xxxx_xx_xx_xxxxxx_create_news_articles_table.php`**: Creates the `news_articles` table for the news page.
    *   **`xxxx_xx_xx_xxxxxx_create_prizes_table.php`**: Creates the `prizes` table to record prize money awarded to players in specific tournaments.
    *   **`xxxx_xx_xx_xxxxxx_create_player_rankings_table.php`**: Creates the `player_rankings` table to store pre-calculated total prize money for each player.
*   **`seeders/`**: Database seeder classes to populate the database with initial data.
    *   **`DatabaseSeeder.php`**: Main seeder that calls other seeders.
    *   **`UserSeeder.php`**: Creates initial admin, organizer, and player accounts.
    *   **`CategorySeeder.php`**: Populates initial tournament categories.
    *   **`VenueSeeder.php`**: Populates initial venues.
    *   **`NewsArticleSeeder.php`**: Populates some initial news articles.

**6. `public/` Directory**

The public directory is the web server's document root. All public-facing assets are served from here.

*   **`css/`**: Compiled CSS files from Sass.
    *   **`app.css`**: Main compiled CSS file.
*   **`js/`**: Compiled JavaScript files.
    *   **`app.js`**: Main compiled JavaScript file.
*   **`img/`**: Static image assets (logos, icons, default placeholders).
*   **`storage/`**: (Symlink) A symbolic link to `storage/app/public` for serving user-uploaded files publicly.
*   **`index.php`**: (File) The entry point for all HTTP requests to the application.
*   **`favicon.ico`**: (File) Website favicon.

**7. `resources/` Directory**

Contains frontend assets like views, uncompiled JavaScript, Sass, and language files.

*   **`js/`**: Uncompiled JavaScript source files.
    *   **`bootstrap.js`**: Initializes core JavaScript functionalities.
    *   **`app.js`**: Main application JavaScript, importing other modules/components.
    *   **`components/`**: (Optional, if using a JS framework like Vue/React) Frontend components for interactive features, e.g., `BracketComponent.vue` for tournament brackets.
    *   **`pages/`**: Page-specific JavaScript, if required.
*   **`lang/`**: Language files for localization.
*   **`sass/`**: Uncompiled Sass (SCSS) stylesheets.
    *   **`app.scss`**: Main Sass file, importing all other stylesheets.
    *   **`_variables.scss`**: Defines global design variables like colors (`#21324C` primary), fonts, and breakpoints for mobile responsiveness.
    *   **`_mixins.scss`**: Reusable Sass mixins.
    *   **`_base.scss`**: Base styles for HTML elements.
    *   **`components/`**: Styles for reusable UI components (buttons, forms, cards).
    *   **`layouts/`**: Styles specific to different layout structures.
    *   **`pages/`**: Page-specific styles.
    *   **`admin/`**: Styles for the admin panel.
    *   **`organizer/`**: Styles for the organizer panel.
*   **`views/`**: Blade template files for the application's user interface.
    *   **`auth/`**: Authentication-related views (login, register, forgot password, reset password).
    *   **`layouts/`**: Reusable layout templates.
        *   **`app.blade.php`**: Base layout for the main application.
        *   **`admin.blade.php`**: Layout specific to the admin dashboard.
        *   **`organizer.blade.php`**: Layout specific to the organizer dashboard.
        *   **`guest.blade.php`**: Layout for non-authenticated users (e.g., welcome page, public news).
    *   **`admin/`**: Views for the administrator panel.
        *   **`users/`**: Views for user management (index, create, edit).
        *   **`tournaments/`**: Views for comprehensive tournament management (overview, settings).
        *   **`news/`**: Views for news article management (index, create, edit).
        *   **`dashboard.blade.php`**: Admin dashboard overview.
    *   **`organizer/`**: Views for functional organizational unit panel.
        *   **`tournaments/`**: Views for tournament creation, editing, participant management, and bracket management.
            *   **`create.blade.php`**: Form to create a new tournament.
            *   **`edit.blade.php`**: Form to edit tournament details.
            *   **`show.blade.php`**: Tournament overview for organizers.
            *   **`manage_players.blade.php`**: Interface to add/remove players, and update prize winners.
            *   **`manage_bracket.blade.php`**: Interface to view and update match results in the double-elimination bracket.
        *   **`dashboard.blade.php`**: Organizer dashboard overview.
    *   **`player/`**: Views for player functionalities.
        *   **`tournaments/`**: Views for viewing and joining tournaments.
            *   **`index.blade.php`**: List of available tournaments.
            *   **`show.blade.php`**: Detailed view of a specific tournament.
            *   **`participate.blade.php`**: Form to join a tournament.
        *   **`profile.blade.php`**: Player's personal profile and tournament history.
        *   **`ranking.blade.php`**: Player ranking display.
    *   **`news/`**: Views for the public news page.
        *   **`index.blade.php`**: List of news articles.
        *   **`show.blade.php`**: Detailed view of a single news article.
    *   **`welcome.blade.php`**: The initial landing page for guests.
    *   **`dashboard.blade.php`**: General authenticated user dashboard.
    *   **`errors/`**: Custom error pages (e.g., `404.blade.php`, `500.blade.php`).

**8. `routes/` Directory**

Defines all application route definitions.

*   **`web.php`**: Defines web routes that handle browser requests (public views, general user access).
*   **`api.php`**: Defines API routes, typically for single-page applications or external services.
*   **`admin.php`**: Defines routes specifically for the administrator panel, grouped and middleware-protected.
*   **`organizer.php`**: Defines routes specifically for the functional organizational unit panel, grouped and middleware-protected.
*   **`player.php`**: Defines routes for player-specific actions and dashboards, grouped and middleware-protected.

**9. `tests/` Directory**

Contains automated tests for the application.

*   **`Feature/`**: Feature tests that test larger parts of the application, simulating user behavior.
    *   **`AuthTest.php`**: Tests authentication processes.
    *   **`AdminPanelTest.php`**: Tests admin functionalities.
    *   **`OrganizerPanelTest.php`**: Tests organizer functionalities.
    *   **`PlayerFunctionsTest.php`**: Tests player functionalities.
    *   **`TournamentManagementTest.php`**: Tests tournament creation, updates, and bracket generation.
    *   **`NewsManagementTest.php`**: Tests news article management.
    *   **`RankingSystemTest.php`**: Tests ranking calculation logic.
*   **`Unit/`**: Unit tests that focus on isolated parts of the code (e.g., individual methods or classes).
    *   **`UserServiceTest.php`**: Tests methods in `UserService`.
    *   **`TournamentBracketServiceTest.php`**: Tests bracket generation and progression logic.
    *   **`RankingServiceTest.php`**: Tests ranking calculation methods.
    *   **`ModelsTest.php`**: Tests model relationships and attributes.

## Database Schema Design
SCHEMADESIGN

This section details the database schema design for the "vietnampool" project. It outlines the data models, relationships, and the overall structure of the database, supporting the various functionalities for administrators, organizational units, and players, including tournament management, ranking, and news updates.

1.  **Table: `users`**
    *   **Description:** Stores general user information, authentication credentials, and defines user roles within the system. All accounts (Administrator, Functional Organizational Unit, Player) originate from this table.
    *   **Columns:**
        *   `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        *   `name` VARCHAR(255) NOT NULL
        *   `email` VARCHAR(255) UNIQUE NOT NULL
        *   `email_verified_at` TIMESTAMP NULL
        *   `password` VARCHAR(255) NOT NULL
        *   `role` ENUM('admin', 'organizer', 'player') NOT NULL DEFAULT 'player'
        *   `remember_token` VARCHAR(100) NULL
        *   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        *   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

2.  **Table: `players`**
    *   **Description:** Holds player-specific details, extending the `users` table for accounts with the 'player' role. This table is crucial for the ranking system.
    *   **Columns:**
        *   `id` BIGINT UNSIGNED PRIMARY KEY (Foreign Key to `users.id`)
        *   `contact_phone` VARCHAR(20) NULL
        *   `date_of_birth` DATE NULL
        *   `address` TEXT NULL
        *   `total_prize_money` DECIMAL(10, 2) NOT NULL DEFAULT 0.00 (Used for player ranking)
        *   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        *   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    *   **Relationships:**
        *   One-to-One: `players.id` references `users.id` (ON DELETE RESTRICT).

3.  **Table: `tournaments`**
    *   **Description:** Stores comprehensive information about each billiards tournament organized through the system.
    *   **Columns:**
        *   `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        *   `organizer_id` BIGINT UNSIGNED NOT NULL (Foreign Key to `users.id` where role='organizer')
        *   `name` VARCHAR(255) NOT NULL
        *   `category` ENUM('9-Ball Singles', '9-Ball Doubles', '10-Ball Singles', '10-Ball Doubles', '8-Ball Singles', '8-Ball Doubles') NOT NULL
        *   `max_participants` SMALLINT UNSIGNED NOT NULL (Up to 64 participants)
        *   `current_entries_count` SMALLINT UNSIGNED NOT NULL DEFAULT 0 (Denormalized count of registered entrants)
        *   `start_time` DATETIME NOT NULL
        *   `venue` VARCHAR(255) NOT NULL
        *   `entry_fee` DECIMAL(8, 2) NOT NULL DEFAULT 0.00
        *   `status` ENUM('scheduled', 'registration_open', 'in_progress', 'completed', 'cancelled') NOT NULL DEFAULT 'scheduled'
        *   `champion_prize` DECIMAL(10, 2) NULL
        *   `runner_up_prize` DECIMAL(10, 2) NULL
        *   `third_place_prize_1` DECIMAL(10, 2) NULL
        *   `third_place_prize_2` DECIMAL(10, 2) NULL
        *   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        *   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    *   **Relationships:**
        *   Many-to-One: `tournaments.organizer_id` references `users.id` (ON DELETE RESTRICT).

4.  **Table: `teams`**
    *   **Description:** Used to manage teams specifically for "Doubles" tournament categories.
    *   **Columns:**
        *   `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        *   `tournament_id` BIGINT UNSIGNED NOT NULL (Foreign Key to `tournaments.id`)
        *   `name` VARCHAR(255) NULL (Can be auto-generated, e.g., "Player A & Player B")
        *   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        *   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    *   **Relationships:**
        *   Many-to-One: `teams.tournament_id` references `tournaments.id` (ON DELETE CASCADE).
        *   Unique Constraint: (`tournament_id`, `name`) for unique team names within a tournament (if names are user-defined).

5.  **Table: `team_members`**
    *   **Description:** A pivot table linking players to teams for doubles tournaments.
    *   **Columns:**
        *   `team_id` BIGINT UNSIGNED NOT NULL (Foreign Key to `teams.id`)
        *   `player_id` BIGINT UNSIGNED NOT NULL (Foreign Key to `players.id`)
        *   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        *   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    *   **Relationships:**
        *   Many-to-Many: `team_id` references `teams.id` (ON DELETE CASCADE), `player_id` references `players.id` (ON DELETE CASCADE).
        *   Primary Key: (`team_id`, `player_id`) to ensure unique player-team membership.

6.  **Table: `tournament_entries`**
    *   **Description:** Acts as a polymorphic entry point for participants in a tournament, allowing either individual players or teams to register.
    *   **Columns:**
        *   `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        *   `tournament_id` BIGINT UNSIGNED NOT NULL (Foreign Key to `tournaments.id`)
        *   `entrant_type` ENUM('player', 'team') NOT NULL (Indicates whether `entrant_id` refers to a player or a team)
        *   `entrant_id` BIGINT UNSIGNED NOT NULL (Foreign Key to either `players.id` or `teams.id` based on `entrant_type`, enforced by application logic)
        *   `registration_date` DATETIME NOT NULL
        *   `seed_number` SMALLINT UNSIGNED NULL
        *   `status` ENUM('registered', 'withdrew', 'eliminated') NOT NULL DEFAULT 'registered'
        *   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        *   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    *   **Relationships:**
        *   Many-to-One: `tournament_entries.tournament_id` references `tournaments.id` (ON DELETE CASCADE).
        *   Polymorphic: `entrant_id` combined with `entrant_type` serves as a "polymorphic" foreign key to `players` or `teams`.
        *   Unique Constraint: (`tournament_id`, `entrant_type`, `entrant_id`) to prevent duplicate entries for the same participant in a tournament.
        *   Index: `idx_entrant` (`entrant_type`, `entrant_id`) for efficient polymorphic queries.

7.  **Table: `matches`**
    *   **Description:** Stores details for each individual match within a tournament, designed to support the double-elimination bracket system.
    *   **Columns:**
        *   `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        *   `tournament_id` BIGINT UNSIGNED NOT NULL (Foreign Key to `tournaments.id`)
        *   `round_number` SMALLINT UNSIGNED NOT NULL
        *   `match_number_in_round` SMALLINT UNSIGNED NOT NULL (Sequential number within a round for display/ordering)
        *   `bracket_type` ENUM('winners', 'losers', 'consolation', 'knockout', 'final') NOT NULL
        *   `entrant1_entry_id` BIGINT UNSIGNED NULL (Foreign Key to `tournament_entries.id`)
        *   `entrant2_entry_id` BIGINT UNSIGNED NULL (Foreign Key to `tournament_entries.id`)
        *   `winner_entry_id` BIGINT UNSIGNED NULL (Foreign Key to `tournament_entries.id`)
        *   `loser_entry_id` BIGINT UNSIGNED NULL (Foreign Key to `tournament_entries.id`)
        *   `score_entrant1` TINYINT UNSIGNED NULL
        *   `score_entrant2` TINYINT UNSIGNED NULL
        *   `status` ENUM('scheduled', 'in_progress', 'completed', 'walkover', 'forfeited', 'pending_players') NOT NULL DEFAULT 'scheduled'
        *   `start_time` DATETIME NULL
        *   `end_time` DATETIME NULL
        *   `location` VARCHAR(100) NULL (e.g., "Table 1")
        *   `parent_match_winner_path_id` BIGINT UNSIGNED NULL (Foreign Key to `matches.id`; the match whose winner proceeds here)
        *   `parent_match_loser_path_id` BIGINT UNSIGNED NULL (Foreign Key to `matches.id`; the match whose loser proceeds here, relevant for loser brackets)
        *   `next_match_winner_path_id` BIGINT UNSIGNED NULL (Foreign Key to `matches.id`; the match where this match's winner proceeds)
        *   `next_match_loser_path_id` BIGINT UNSIGNED NULL (Foreign Key to `matches.id`; the match where this match's loser proceeds)
        *   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        *   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    *   **Relationships:**
        *   Many-to-One: `matches.tournament_id` references `tournaments.id` (ON DELETE CASCADE).
        *   Many-to-One: `entrant1_entry_id`, `entrant2_entry_id`, `winner_entry_id`, `loser_entry_id` reference `tournament_entries.id` (ON DELETE SET NULL).
        *   Self-Referencing: `parent_match_winner_path_id`, `parent_match_loser_path_id`, `next_match_winner_path_id`, `next_match_loser_path_id` reference `matches.id` (ON DELETE SET NULL) to form the bracket structure.
        *   Unique Constraint: (`tournament_id`, `round_number`, `match_number_in_round`, `bracket_type`) for unique identification of each match within a tournament bracket.

8.  **Table: `tournament_prizes_awarded`**
    *   **Description:** Records which entrants (players or teams) won specific prizes in a tournament. This data is used to update player rankings.
    *   **Columns:**
        *   `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        *   `tournament_id` BIGINT UNSIGNED NOT NULL (Foreign Key to `tournaments.id`)
        *   `entrant_entry_id` BIGINT UNSIGNED NOT NULL (Foreign Key to `tournament_entries.id`)
        *   `prize_type` ENUM('champion', 'runner_up', 'third_place_1', 'third_place_2', 'participation') NOT NULL
        *   `amount` DECIMAL(10, 2) NOT NULL
        *   `awarded_date` DATETIME NOT NULL
        *   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        *   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    *   **Relationships:**
        *   Many-to-One: `tournament_prizes_awarded.tournament_id` references `tournaments.id` (ON DELETE CASCADE).
        *   Many-to-One: `tournament_prizes_awarded.entrant_entry_id` references `tournament_entries.id` (ON DELETE RESTRICT).
        *   Unique Constraint: (`tournament_id`, `entrant_entry_id`, `prize_type`) to ensure an entrant doesn't receive the same prize type twice in one tournament.

9.  **Table: `news`**
    *   **Description:** Stores articles for the news page, created by administrator accounts.
    *   **Columns:**
        *   `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        *   `title` VARCHAR(255) NOT NULL
        *   `slug` VARCHAR(255) UNIQUE NOT NULL (For friendly URLs)
        *   `content` TEXT NOT NULL
        *   `author_id` BIGINT UNSIGNED NOT NULL (Foreign Key to `users.id` where role='admin')
        *   `published_at` DATETIME NULL (Allows scheduling of news articles)
        *   `is_published` BOOLEAN NOT NULL DEFAULT TRUE
        *   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        *   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    *   **Relationships:**
        *   Many-to-One: `news.author_id` references `users.id` (ON DELETE RESTRICT).

10. **Table: `news_media`**
    *   **Description:** Stores embedded images and videos associated with news articles.
    *   **Columns:**
        *   `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        *   `news_id` BIGINT UNSIGNED NOT NULL (Foreign Key to `news.id`)
        *   `media_type` ENUM('image', 'video') NOT NULL
        *   `url` VARCHAR(2048) NOT NULL (URL to the media asset)
        *   `caption` VARCHAR(500) NULL
        *   `order_index` SMALLINT UNSIGNED NOT NULL DEFAULT 0 (For display order within an article)
        *   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        *   `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    *   **Relationships:**
        *   Many-to-One: `news_media.news_id` references `news.id` (ON DELETE CASCADE).

**Key Relationships Summary:**

*   **Users & Roles:** The `users` table is central, with a `role` column defining access. Players have an extended profile in the `players` table. Organizers are `users` with the 'organizer' role.
*   **Tournament Organization:** Organizers create `tournaments`. `tournament_entries` track participants (players or teams).
*   **Doubles Support:** `teams` and `team_members` tables facilitate the organization and tracking of teams for doubles categories. `tournament_entries` then abstracts whether an entrant is a single player or a team.
*   **Bracket Management:** The `matches` table is extensively linked internally and to `tournament_entries` to fully represent the double-elimination bracket, including progress through rounds and transitions between winner/loser brackets and knockout stages.
*   **Ranking System:** `tournament_prizes_awarded` records prize winnings, which are aggregated into `players.total_prize_money` to maintain player rankings.
*   **News Content:** `news` stores articles, and `news_media` stores associated images and videos, all managed by 'admin' users.

**Performance and Scalability Considerations:**

*   **Indexing:** All primary keys are indexed automatically. Foreign key columns and frequently queried columns (e.g., `email` in `users`, `tournament_id` in `matches`, `created_at` in `news`) should have B-tree indexes for optimal query performance. The polymorphic `entrant_type`, `entrant_id` in `tournament_entries` is explicitly indexed.
*   **Data Types:** Appropriate data types (e.g., `BIGINT UNSIGNED`, `SMALLINT UNSIGNED`, `DECIMAL`) are chosen to balance storage efficiency and range requirements.
*   **Denormalization:** `current_entries_count` in `tournaments` and `total_prize_money` in `players` are denormalized fields for quick access to frequently needed data, reducing the need for complex joins or aggregate queries in common scenarios. These will be updated via application logic or database triggers.
*   **Concurrent Users:** The schema is designed with standard relational database principles, which can handle the anticipated 500 concurrent users and 64-participant tournaments efficiently with proper indexing and application-level caching where necessary.

## User Flow
USERFLOW

This section details the user journeys, key interaction patterns, and wireframe descriptions for the vietnampool system, categorized by user account type. The design adheres to a modern sports style, with a user-friendly UI/UX that adapts seamlessly to mobile devices, featuring "#21324C" as the primary color theme.



--- 



**1. Administrator User Flows**



**1.1. User Goal: Manage User Accounts (Functional Organizational Units & Players)**



*   **Flow Steps:**

    *   **Step 1: Admin Login**

        *   **Wireframe Description:** A login page with the project logo centered. Input fields for "Email" and "Password" with labels, a "Forgot Password?" link, and a prominent "Login" button. The layout is clean and mobile-responsive.

        *   **Interaction:** Admin enters credentials and clicks "Login".

        *   **System Response:** Validates credentials. If successful, redirects to the Admin Dashboard. If failed, displays an error message.

        *   **Next Step/Outcome:** Admin Dashboard.

    *   **Step 2: Navigate to User Management**

        *   **Wireframe Description:** Admin Dashboard with a left-hand navigation sidebar or a top-bar menu. Menu items include "Dashboard", "User Management", "Tournament Management", "News Management". The main content area might show system overview widgets.

        *   **Interaction:** Admin clicks on "User Management" in the navigation menu.

        *   **System Response:** Loads the User Management page.

        *   **Next Step/Outcome:** User Management Page.

    *   **Step 3: View User List**

        *   **Wireframe Description:** User Management page displaying a table of all registered users. Columns include "Name", "Email", "Account Type", "Status", and "Actions" (Edit, Delete). Above the table, there's a search bar, filter options (e.g., by "Account Type": Administrator, FOU, Player), and a "Create New User" button. On mobile, the table might transform into cards or collapse rows for better readability.

        *   **Interaction:** Admin can search for users, filter the list, or view existing users.

        *   **System Response:** Updates the displayed user list based on search/filter criteria.

        *   **Next Step/Outcome:** Ready to Create, Edit, or Delete a user.

    *   **Step 4: Create New User**

        *   **Wireframe Description:** A modal or a new page containing a form for "Create New User". Fields include "Name", "Email", "Password", "Confirm Password", "Account Type" (dropdown with options: Functional Organizational Unit, Player), and an optional "Status" (Active/Inactive) checkbox. "Save" and "Cancel" buttons are at the bottom.

        *   **Interaction:** Admin clicks "Create New User" button from the User List page, fills out the form, and clicks "Save".

        *   **System Response:** Validates input. If successful, creates the new user account and adds it to the database, then refreshes the User List. If validation fails, displays error messages for invalid fields.

        *   **Next Step/Outcome:** User List page with the newly added user.

    *   **Step 5: Edit User**

        *   **Wireframe Description:** A modal or a new page containing a form similar to "Create New User", pre-filled with the selected user's current information. The "Password" field might be optional or require confirmation for changes. "Save Changes" and "Cancel" buttons are at the bottom.

        *   **Interaction:** Admin clicks the "Edit" action button next to a user in the list, modifies the necessary fields, and clicks "Save Changes".

        *   **System Response:** Updates the user's information in the database and refreshes the User List. Displays a success message or error message if applicable.

        *   **Next Step/Outcome:** User List page with updated user information.

    *   **Step 6: Delete User**

        *   **Wireframe Description:** A confirmation modal asking "Are you sure you want to delete [User's Name]?" with "Confirm" and "Cancel" buttons.

        *   **Interaction:** Admin clicks the "Delete" action button next to a user, then confirms in the modal.

        *   **System Response:** Removes the user from the database. Displays a success message and refreshes the User List.

        *   **Next Step/Outcome:** User List page with the user removed.



**1.2. User Goal: Manage News Content**



*   **Flow Steps:**

    *   **Step 1: Navigate to News Management (from Admin Dashboard)**

        *   **Wireframe Description:** Admin Dashboard with navigation. (Refer to Step 2 in 1.1)

        *   **Interaction:** Admin clicks "News Management" in the navigation menu.

        *   **System Response:** Loads the News Management page.

        *   **Next Step/Outcome:** News Management Page.

    *   **Step 2: View News List**

        *   **Wireframe Description:** News Management page displaying a table or card list of news articles. Columns/cards show "Title", "Author", "Publish Date", "Status" (Draft/Published), and "Actions" (View, Edit, Delete). A "Create New Article" button is prominently displayed.

        *   **Interaction:** Admin views existing news articles.

        *   **System Response:** Displays the list of news articles.

        *   **Next Step/Outcome:** Ready to Create, Edit, or Delete an article.

    *   **Step 3: Create New News Article**

        *   **Wireframe Description:** A page with a form for "Create News Article". Fields include "Title" (text input), "Content" (rich text editor with options for bold, italics, lists, and "Embed Image/Video" functionality), "Publish Date" (date picker), and "Status" (dropdown: Draft, Published). "Save" and "Cancel" buttons are at the bottom.

        *   **Interaction:** Admin clicks "Create New Article", fills out the form including embedding images/videos as needed, and clicks "Save".

        *   **System Response:** Validates input. If successful, saves the article to the database and redirects to the News List. If validation fails, displays error messages.

        *   **Next Step/Outcome:** News List page with the new article.

    *   **Step 4: Edit News Article**

        *   **Wireframe Description:** A page similar to the "Create News Article" form, pre-filled with the selected article's content. "Save Changes" and "Cancel" buttons are at the bottom.

        *   **Interaction:** Admin clicks "Edit" next to an article, modifies content, and clicks "Save Changes".

        *   **System Response:** Updates the article in the database and redirects to the News List. Displays success/error.

        *   **Next Step/Outcome:** News List page with updated article.

    *   **Step 5: Delete News Article**

        *   **Wireframe Description:** A confirmation modal "Are you sure you want to delete this news article?" with "Confirm" and "Cancel" buttons.

        *   **Interaction:** Admin clicks "Delete" next to an article, then confirms in the modal.

        *   **System Response:** Removes the article from the database and refreshes the News List. Displays success message.

        *   **Next Step/Outcome:** News List page with the article removed.



**1.3. User Goal: High-Level Tournament Management (Oversight)**



*   **Flow Steps:**

    *   **Step 1: Navigate to Tournament Management (from Admin Dashboard)**

        *   **Wireframe Description:** Admin Dashboard with navigation. (Refer to Step 2 in 1.1)

        *   **Interaction:** Admin clicks "Tournament Management" in the navigation menu.

        *   **System Response:** Loads the Tournament Management page.

        *   **Next Step/Outcome:** Tournament Management Page.

    *   **Step 2: View All Tournaments**

        *   **Wireframe Description:** A table or card list displaying all tournaments, regardless of creation origin (Admin or FOU). Columns/cards include "Tournament Name", "Category", "Start Date", "Venue", "Status" (Upcoming, Ongoing, Completed), "Created By", and "Actions" (View Details, Delete). A search bar and filter options (by Status, Category) are available.

        *   **Interaction:** Admin browses the list of tournaments.

        *   **System Response:** Displays the list of tournaments.

        *   **Next Step/Outcome:** Ready to Delete or View Details of a tournament.

    *   **Step 3: Delete Tournament**

        *   **Wireframe Description:** A confirmation modal "Are you sure you want to delete [Tournament Name]?" with "Confirm" and "Cancel" buttons.

        *   **Interaction:** Admin clicks "Delete" next to a tournament, then confirms in the modal.

        *   **System Response:** Removes the tournament and all associated data (participants, bracket, results) from the database. Displays a success message and refreshes the Tournament List. This action is irreversible.

        *   **Next Step/Outcome:** Tournament List page with the tournament removed.



--- 



**2. Functional Organizational Unit (FOU) User Flows**



**2.1. User Goal: Manage Tournaments (Add, Edit, Delete Tournament Details)**



*   **Flow Steps:**

    *   **Step 1: FOU Login**

        *   **Wireframe Description:** Similar to Admin Login (refer to Step 1 in 1.1), but credentials are for FOU accounts.

        *   **Interaction:** FOU enters credentials and clicks "Login".

        *   **System Response:** Validates credentials. Redirects to FOU Dashboard (likely a tournament-focused dashboard).

        *   **Next Step/Outcome:** FOU Dashboard.

    *   **Step 2: Navigate to Tournament Management**

        *   **Wireframe Description:** FOU Dashboard with navigation for "My Tournaments", "Reports", "Profile". The main content area lists tournaments managed by this FOU. A "Create New Tournament" button is prominent.

        *   **Interaction:** FOU clicks "My Tournaments" or directly interacts with the tournament list.

        *   **System Response:** Displays the list of tournaments managed by the FOU.

        *   **Next Step/Outcome:** FOU Tournament List Page.

    *   **Step 3: Create New Tournament**

        *   **Wireframe Description:** A dedicated page with a form for "Create New Tournament". Fields include: "Tournament Name", "Category" (dropdown: 9-ball singles, 9-ball doubles, 10-ball singles, 10-ball doubles, 8-ball singles, 8-ball doubles), "Number of Participants" (numeric input, up to 64), "Start Date & Time" (date/time picker), "Venue", "Entry Fee" (numeric), "Prize Amounts" (numeric inputs for Champion, Runner-up, Third Place 1, Third Place 2). "Save Tournament" and "Cancel" buttons at the bottom.

        *   **Interaction:** FOU clicks "Create New Tournament", fills all required fields, and clicks "Save Tournament".

        *   **System Response:** Validates input. If successful, creates the tournament entry in the database and redirects to the Tournament Details page for the newly created tournament. Displays success/error.

        *   **Next Step/Outcome:** Tournament Details Page (for the new tournament).

    *   **Step 4: View/Edit Tournament Details**

        *   **Wireframe Description:** Tournament Details page with tabs or sections for "Overview", "Participants", "Bracket", "Results", "Prizes". The "Overview" section displays all tournament information (name, category, dates, venue, fees, prizes) in a read-only format initially, with an "Edit Tournament" button.

        *   **Interaction:** FOU selects a tournament from the list, then clicks "Edit Tournament".

        *   **System Response:** The "Overview" section becomes editable, or a new form (similar to "Create New Tournament") pre-filled with current details appears. "Save Changes" and "Cancel" buttons are available.

        *   **Next Step/Outcome:** FOU modifies details, clicks "Save Changes". System updates the database and reverts to read-only view. Displays success/error.



**2.2. User Goal: Manage Participating Players**



*   **Flow Steps:**

    *   **Step 1: Navigate to Tournament Details -> Participants Tab**

        *   **Wireframe Description:** On the Tournament Details page, FOU clicks the "Participants" tab/section.

        *   **Interaction:** FOU clicks "Participants".

        *   **System Response:** Displays the Participants management section.

        *   **Next Step/Outcome:** Participants List for the selected tournament.

    *   **Step 2: View and Add/Remove Participants**

        *   **Wireframe Description:** The "Participants" section shows a list/table of registered players for the tournament (Name, Email, Status: Registered/Checked-in). A search bar for existing players and an "Add New Player" button are present. Each player entry has "Remove" or "Edit" actions. A "Confirm Participants" button is available once registration is closed or participants are finalized.

        *   **Interaction (Add Existing Player):** FOU searches for a player, selects them from results, and clicks "Add".

        *   **Interaction (Add New Player Manually):** FOU clicks "Add New Player", fills out a small form (Name, Email, Contact), and clicks "Save".

        *   **Interaction (Remove Player):** FOU clicks "Remove" next to a player, confirms in a modal.

        *   **System Response:** Adds/removes players from the tournament's participant list in the database. Updates the displayed list.

        *   **Next Step/Outcome:** Updated Participants List.



**2.3. User Goal: Manage Competition Diagram (Double-Elimination Bracket) & Update Match Results**



*   **Flow Steps:**

    *   **Step 1: Navigate to Tournament Details -> Bracket Tab**

        *   **Wireframe Description:** On the Tournament Details page, FOU clicks the "Bracket" tab/section. Initially, if no bracket is generated, a "Generate Bracket" button is displayed.

        *   **Interaction:** FOU clicks "Bracket".

        *   **System Response:** Displays the bracket management section.

        *   **Next Step/Outcome:** Bracket Generation/Display Area.

    *   **Step 2: Generate Initial Bracket**

        *   **Wireframe Description:** If participants are confirmed, a "Generate Bracket" button is active. Clicking it reveals a visual representation of the double-elimination bracket for Round 1, with player names randomly seeded (or based on pre-defined seeding if implemented). The bracket UI is interactive, allowing FOU to click on individual matches.

        *   **Interaction:** FOU clicks "Generate Bracket".

        *   **System Response:** System automatically creates the initial double-elimination bracket structure based on the confirmed participants. Displays Round 1 matches.

        *   **Next Step/Outcome:** Interactive bracket displayed, ready for match result input.

    *   **Step 3: Update Match Results (Iterative Process)**

        *   **Wireframe Description:** The interactive bracket shows each match. Clicking on a match opens a modal or expands a section to input scores (e.g., Player A Score, Player B Score) or select a winner from a dropdown. "Save Result" and "Cancel" buttons are present.

        *   **Interaction:** FOU clicks a match, inputs scores/winner, and clicks "Save Result".

        *   **System Response:** 

            *   **Round 1:** Records the match result. The winner progresses to the Winners Bracket Round 2, and the loser progresses to the Losers Bracket Round 2. The bracket visually updates.

            *   **Round 2 (Winners Bracket):** Records the match result. Winners advance directly to the knockout stage. Losers move to Round 3 to play against winners from the Losers Bracket Round 2. The bracket visually updates.

            *   **Round 2 (Losers Bracket):** Records the match result. Winners advance to Round 3 to play against losers from the Winners Bracket Round 2. Losers are eliminated from the tournament. The bracket visually updates.

            *   **Round 3:** Records the match result. Winners proceed to the knockout stage (final phase). Losers are eliminated. The bracket visually updates.

            *   **Knockout Stage (Final Phase - Single Elimination):** Records match results. Eliminated players are removed from the bracket. The bracket updates until the final winner (Champion) and runner-up are determined.

        *   **Next Step/Outcome:** Visually updated bracket, FOU continues to update subsequent matches until the tournament concludes.



**2.4. User Goal: Update Prize Winners and Ranking**



*   **Flow Steps:**

    *   **Step 1: Navigate to Tournament Details -> Prizes/Ranking Tab (after tournament conclusion)**

        *   **Wireframe Description:** On the Tournament Details page, FOU clicks the "Prizes/Ranking" tab/section. This section becomes available after the bracket has determined a Champion, Runner-up, and potentially third-place finishers.

        *   **Interaction:** FOU clicks "Prizes/Ranking".

        *   **System Response:** Loads the prize and ranking update interface.

        *   **Next Step/Outcome:** Prize Assignment Page.

    *   **Step 2: Assign Prize Winners**

        *   **Wireframe Description:** The Prize Assignment page displays input fields or dropdowns for "Champion", "Runner-up", "Third Place 1", and "Third Place 2". These fields might auto-populate with the players identified by the completed bracket. Next to each field, the associated prize amount (from tournament setup) is displayed. A "Confirm Prizes & Update Ranking" button is prominent.

        *   **Interaction:** FOU reviews the auto-populated winners (or manually selects if needed), and clicks "Confirm Prizes & Update Ranking".

        *   **System Response:** 

            *   Records the prize money earned by each winning player for this specific tournament.

            *   Updates each player's total prize money across all tournaments in the ranking system.

            *   Displays a success message and marks the tournament as "Prize Processed".

        *   **Next Step/Outcome:** Tournament marked as completed, player rankings updated.



--- 



**3. Player User Flows**



**3.1. User Goal: Register for a Tournament**



*   **Flow Steps:**

    *   **Step 1: Access Tournament List (Guest or Logged In)**

        *   **Wireframe Description:** Homepage or "Tournaments" page with a clear header (logo, navigation: Home, Tournaments, News, Rankings, Login/Profile). The main content area lists upcoming and ongoing tournaments as cards or a table. Each card/row shows "Tournament Name", "Category", "Start Date", "Venue", "Entry Fee", and a "View Details" button. Filtering and search options are available.

        *   **Interaction:** Player navigates to the Tournaments section.

        *   **System Response:** Displays the list of available tournaments.

        *   **Next Step/Outcome:** Tournament List Page.

    *   **Step 2: View Tournament Details**

        *   **Wireframe Description:** Tournament Details page with an "Overview" section (Tournament Name, Category, Start/End Time, Venue, Entry Fee, Prize Amounts), a "Participants" list, and a "Bracket" section (if available/generated). A prominent "Register Now" button is displayed if registration is open.

        *   **Interaction:** Player clicks "View Details" for a specific tournament.

        *   **System Response:** Loads the detailed information for the selected tournament.

        *   **Next Step/Outcome:** Specific Tournament Details Page.

    *   **Step 3: Register for Tournament**

        *   **Wireframe Description:** If not logged in, clicking "Register Now" prompts the player to login or register for a player account. If logged in, a confirmation modal "Confirm Registration for [Tournament Name]?" appears, showing the entry fee and potentially terms & conditions, with "Confirm" and "Cancel" buttons.

        *   **Interaction:** Player clicks "Register Now", logs in/registers if necessary, then confirms registration.

        *   **System Response:** Validates player eligibility (e.g., already registered, account status). If successful, adds the player to the tournament's participant list. Displays a success message ("Registration Successful!") and sends a confirmation email. If failed (e.g., registration closed), displays an error.

        *   **Next Step/Outcome:** Tournament Details page, with player's status updated (e.g., "Registered").



**3.2. User Goal: View Tournament Information & Bracket**



*   **Flow Steps:**

    *   **Step 1: Access Tournament Details (as in 3.1, Step 2)**

    *   **Step 2: View Tournament Information (Overview, Participants)**

        *   **Wireframe Description:** The "Overview" section of the Tournament Details page displays all public tournament information. The "Participants" tab/section lists all registered players, typically by name.

        *   **Interaction:** Player views the tournament details and participant list.

        *   **System Response:** Displays the requested information.

        *   **Next Step/Outcome:** Information reviewed.

    *   **Step 3: View Competition Bracket**

        *   **Wireframe Description:** The "Bracket" tab/section displays a dynamic, visual representation of the double-elimination bracket. Matches are clearly marked, showing player names, current scores (for ongoing matches), and how players progress through the winners and losers brackets. Completed matches show winners. The bracket should be responsive and navigable (e.g., zoomable, scrollable) on mobile devices.

        *   **Interaction:** Player clicks the "Bracket" tab to view the competition flow.

        *   **System Response:** Renders the current state of the tournament bracket.

        *   **Next Step/Outcome:** Player views the bracket and follows tournament progress.



**3.3. User Goal: View Personal Tournament History**



*   **Flow Steps:**

    *   **Step 1: Player Login**

        *   **Wireframe Description:** Standard login page (refer to 1.1, Step 1).

        *   **Interaction:** Player logs in with their credentials.

        *   **System Response:** Redirects to Player Dashboard/Profile page.

        *   **Next Step/Outcome:** Player Dashboard/Profile.

    *   **Step 2: Navigate to My Tournaments/Profile**

        *   **Wireframe Description:** Player Dashboard/Profile page with navigation options for "My Tournaments", "Account Settings", etc. The main content area might show a summary of player stats.

        *   **Interaction:** Player clicks "My Tournaments" or "View History" within their profile.

        *   **System Response:** Loads the player's tournament history page.

        *   **Next Step/Outcome:** Player Tournament History Page.

    *   **Step 3: View List of Participated Tournaments**

        *   **Wireframe Description:** A list or table of tournaments the player has participated in. Each entry shows "Tournament Name", "Date", "Category", "Result" (e.g., Champion, Runner-up, Eliminated in Round X), and "Prize Money Won". A "View Details" link for each tournament is available.

        *   **Interaction:** Player scrolls through their tournament history.

        *   **System Response:** Displays the compiled list of past and current tournaments for the logged-in player.

        *   **Next Step/Outcome:** Player can review their history or click "View Details" for a specific tournament.



**3.4. User Goal: View Overall Player Rankings**



*   **Flow Steps:**

    *   **Step 1: Access Rankings Page (Guest or Logged In)**

        *   **Wireframe Description:** Main navigation bar includes a "Rankings" link. Clicking it leads to the Rankings page. This page features a leader-board style table. Columns include "Rank", "Player Name", "Total Prize Money Earned", and "Tournaments Played" (optional). Filter options (e.g., by Category, Time Period) could be present. The layout is clean and emphasizes player achievements.

        *   **Interaction:** Player navigates to the "Rankings" page.

        *   **System Response:** Displays the list of players, sorted by "Total Prize Money Earned" in descending order.

        *   **Next Step/Outcome:** Player views the overall ranking of amateur players.



**3.5. User Goal: View Latest News**



*   **Flow Steps:**

    *   **Step 1: Access News Page (Guest or Logged In)**

        *   **Wireframe Description:** Main navigation bar includes a "News" link. The News page displays a chronological list of news articles, typically as cards or snippets. Each card shows a "Title", "Date", a short "Excerpt", and a "Read More" button. A featured article might be highlighted at the top. The layout is visually engaging, allowing for prominent display of images/videos.

        *   **Interaction:** Player navigates to the "News" page.

        *   **System Response:** Displays the list of latest news articles.

        *   **Next Step/Outcome:** News List Page.

    *   **Step 2: View Full News Article**

        *   **Wireframe Description:** Full News Article page displays the article "Title", "Publish Date", and the complete "Content". Embedded images and videos are displayed inline within the content. Sharing buttons (social media) might be present. A "Back to News" link returns to the list.

        *   **Interaction:** Player clicks "Read More" on a news article card.

        *   **System Response:** Loads and displays the full content of the selected news article.

        *   **Next Step/Outcome:** Player reads the news article, which may include information about professional tournaments.

## Styling Guidelines
STYLING GUIDELINES

This document outlines the styling guidelines for the "vietnampool" application, ensuring a consistent, modern, and user-friendly visual experience across all platforms and user types. Adherence to these guidelines is crucial for maintaining brand identity, enhancing usability, and providing an intuitive interface for administrators, organizational units, and players.

1. DESIGN PRINCIPLES

Our design approach prioritizes a "modern sports style" fused with practical usability. Key principles include:

*   **Modern Sports Aesthetic**: Dynamic and energetic visuals, clean lines, and a professional look that resonates with the competitive spirit of billiards.
*   **User-Centric Design**: Intuitive navigation and clear information hierarchy to ensure ease of use for all user types, from amateur players viewing rankings to organizers managing complex tournaments.
*   **Mobile Responsiveness**: The interface must adapt seamlessly to various screen sizes, ensuring an optimal experience on mobile devices, tablets, and desktops.
*   **Clarity and Readability**: Especially critical for displaying tournament brackets, player rankings, scores, and news articles. Information should be easily digestible at a glance.
*   **Consistency**: Uniformity in design elements, interactions, and content presentation across the entire application to build familiarity and trust.

2. COLOR PALETTE

The color palette is designed to reflect the project's identity – professional, sporty, and engaging – while adhering to the primary color theme of "#21324C".

*   **Primary Color**: Deep Navy Blue
    *   **Hex**: #21324C
    *   **Usage**: Dominant brand color, used for headers, primary call-to-action buttons, key navigation elements, and important background accents. Represents professionalism, stability, and depth.

*   **Secondary/Accent Colors**:
    *   **Emerald Green (Action/Success)**:
        *   **Hex**: #388E3C
        *   **Usage**: Used for positive actions, success messages, highlighted statistics, and elements signifying progress or victory. Evokes the billiard table felt and growth.
    *   **Amber (Highlight/Champion)**:
        *   **Hex**: #FFC107
        *   **Usage**: Used for highlighting champions, prize money, important alerts, and secondary call-to-action buttons. Adds warmth and draws attention to significant information.

*   **Neutral Colors**:
    *   **Pure White (Background/Text)**:
        *   **Hex**: #FFFFFF
        *   **Usage**: Clean backgrounds for content areas, primary text on dark backgrounds.
    *   **Light Gray (Background/Dividers)**:
        *   **Hex**: #F5F5F5
        *   **Usage**: Section backgrounds, subtle dividers, inactive states.
    *   **Dark Gray (Body Text)**:
        *   **Hex**: #333333
        *   **Usage**: Primary body text, labels, and general content.
    *   **Black (Headings/Strong Text)**:
        *   **Hex**: #000000
        *   **Usage**: Main headings, critical text elements, icon accents.

*   **Semantic Colors**:
    *   **Success**: #4CAF50 (Green)
    *   **Warning**: #FF9800 (Orange)
    *   **Error**: #F44336 (Red)
    *   **Info**: #2196F3 (Light Blue)
    *   **Usage**: System messages, alerts, and status indicators.

3. TYPOGRAPHY

Typography is selected for optimal readability, modern aesthetic, and strong visual hierarchy. A combination of a strong heading font and a highly readable body font ensures a pleasant user experience.

*   **Font Families**:
    *   **Headings & Display**: "Montserrat" (Sans-serif)
        *   **Usage**: H1-H6, prominent titles, call-to-action text. Its geometric and modern feel aligns with the sports aesthetic.
    *   **Body Text & UI Elements**: "Roboto" (Sans-serif)
        *   **Usage**: Paragraphs, labels, button text, table content. Known for its clarity and excellent readability across various screen sizes.
    *   **Fallback**: `sans-serif`

*   **Font Weights**:
    *   "Montserrat": Bold (700), Semi-Bold (600), Medium (500)
    *   "Roboto": Regular (400), Medium (500), Bold (700)

*   **Font Sizing (Desktop Base)**:
    *   **H1**: 48px (Bold, "Montserrat")
    *   **H2**: 36px (Semi-Bold, "Montserrat")
    *   **H3**: 24px (Medium, "Montserrat")
    *   **H4**: 18px (Medium, "Roboto")
    *   **H5**: 16px (Medium, "Roboto")
    *   **H6**: 14px (Bold, "Roboto")
    *   **Body Text (Base)**: 16px (Regular, "Roboto")
    *   **Small Text/Captions**: 14px (Regular, "Roboto")
    *   **Link/Button Text**: 16px (Medium, "Roboto")

*   **Line Height**: 
    *   Headings: 1.2 - 1.3em
    *   Body Text: 1.5 - 1.6em

4. ICONOGRAPHY

Icons are essential for quick comprehension and an intuitive interface.

*   **Style**: Clean, modern, and consistent (either all outlined or all filled). Icons should be easily recognizable and scalable.
*   **Source**: Utilize a consistent icon library (e.g., Material Design Icons, Font Awesome) to ensure uniformity.
*   **Usage**: Clearly represent functions like account management, tournament details, player profiles, rankings, news, etc.

5. IMAGERY & MEDIA

Visual content plays a significant role, especially in the news section.

*   **Quality**: All images and videos must be high-resolution, professional, and relevant to the content.
*   **News Page**: News articles can include embedded images and videos. Ensure images have appropriate aspect ratios and are optimized for web loading performance. Videos should be embedded responsively.
*   **Tournament Graphics**: Visuals for tournament promotions, venue images, and player photos should maintain a consistent, clear, and engaging style.

6. SPACING & LAYOUT

Consistent spacing ensures visual balance, readability, and a structured layout.

*   **Grid System**: Implement a responsive, 12-column grid system to manage content placement and ensure adaptability across different screen sizes.
*   **Modular Scale**: Utilize a consistent spacing scale, preferably based on multiples of 8px or 16px, for margins, padding, and component spacing.
*   **Content Separation**: Employ sufficient white space around content blocks and between UI elements to prevent clutter and improve readability.

7. UI COMPONENTS (GENERAL PRINCIPLES)

All interactive elements and content displays should adhere to these general principles for consistency and usability.

*   **Buttons**: Clear hierarchy (primary, secondary, tertiary, outline, destructive). Consistent hover, focus, and active states. Call-to-action buttons should be prominent (e.g., using #388E3C or #21324C).
*   **Forms**: Clear and concise labels. Input fields should have distinct borders, focus states, and visible validation (error/success) messages. Group related form elements logically.
*   **Tables**: Essential for displaying data like player rankings, tournament participants, and match results. Tables should be highly readable, with clear headers, sufficient padding, and optional alternating row colors for large datasets.
*   **Navigation**: Intuitive and consistent navigation patterns. Clearly indicate the user's current location within the application. Implement a mobile-friendly navigation solution (e.g., hamburger menu).
*   **Tournament Brackets**: Given the complexity of double-elimination, visual clarity is paramount. Use distinct lines and boxes to clearly show player paths, match outcomes, and progression through winners' and losers' brackets. Highlight active matches or important information using accent colors.

8. ACCESSIBILITY

Design choices should consider accessibility to ensure the application is usable by the broadest possible audience.

*   **Color Contrast**: Ensure all text and interactive elements meet WCAG 2.1 AA guidelines for color contrast ratios.
*   **Keyboard Navigation**: All interactive elements (buttons, links, form fields) must be fully navigable and operable using only a keyboard.
*   **Semantic HTML**: Utilize appropriate HTML5 semantic elements to provide a robust structure for assistive technologies.
*   **Focus Indicators**: Clearly visible focus indicators for all interactive elements.

These guidelines serve as the foundation for the "vietnampool" application's visual and interactive design, ensuring a high-quality, engaging, and professional user experience.
