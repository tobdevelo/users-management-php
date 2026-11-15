<?php

declare(strict_types=1);

final class ClassLoader
{
    /**
     * @var array<string, string>
     */
    private static array $classMap = array(
        // Domain - Usuarios y Email
        'InvalidUserEmailException' => 'Domain/Exceptions/InvalidUserEmailException.php',
        'InvalidUserIdException' => 'Domain/Exceptions/InvalidUserIdException.php',
        'InvalidUserNameException' => 'Domain/Exceptions/InvalidUserNameException.php',
        'InvalidUserPasswordException' => 'Domain/Exceptions/InvalidUserPasswordException.php',
        'InvalidUserRoleException' => 'Domain/Exceptions/InvalidUserRoleException.php',
        'InvalidUserStatusException' => 'Domain/Exceptions/InvalidUserStatusException.php',
        'UserAlreadyExistsException' => 'Domain/Exceptions/UserAlreadyExistsException.php',
        'UserNotFoundException' => 'Domain/Exceptions/UserNotFoundException.php',
        'InvalidCredentialsException' => 'Domain/Exceptions/InvalidCredentialsException.php',

        'UserRoleEnum' => 'Domain/Enums/UserRoleEnum.php',
        'UserStatusEnum' => 'Domain/Enums/UserStatusEnum.php',

        'UserId' => 'Domain/ValueObjects/UserId.php',
        'UserName' => 'Domain/ValueObjects/UserName.php',
        'UserEmail' => 'Domain/ValueObjects/UserEmail.php',
        'UserPassword' => 'Domain/ValueObjects/UserPassword.php',

        'UserModel' => 'Domain/Models/UserModel.php',
        'EmailDestinationModel' => 'Domain/Models/EmailDestinationModel.php',
        'EmailSenderException' => 'Domain/Exceptions/EmailSenderException.php',
        'EmailSenderPort' => 'Application/Ports/Out/EmailSenderPort.php',
        'EmailNotificationService' => 'Application/Services/EmailNotificationService.php',
        'EmailSenderService' => 'Infrastructure/Adapters/Email/EmailSenderService.php',

        // Domain - Noticias (Ejercicio 29)
        'InvalidNoticiaDataException' => 'Domain/Exceptions/InvalidNoticiaDataException.php',
        'NivelPublicoEnum' => 'Domain/Enums/NivelPublicoEnum.php',
        'NoticiaId' => 'Domain/ValueObjects/NoticiaId.php',
        'NoticiaCategoria' => 'Domain/ValueObjects/NoticiaCategoria.php',
        'NoticiaFecha' => 'Domain/ValueObjects/NoticiaFecha.php',
        'NoticiaPais' => 'Domain/ValueObjects/NoticiaPais.php',
        'NoticiaDepartamento' => 'Domain/ValueObjects/NoticiaDepartamento.php',
        'NoticiaCiudad' => 'Domain/ValueObjects/NoticiaCiudad.php',
        'NoticiaPeriodista' => 'Domain/ValueObjects/NoticiaPeriodista.php',
        'NoticiaProgramaEmite' => 'Domain/ValueObjects/NoticiaProgramaEmite.php',
        'NoticiaFechaEmision' => 'Domain/ValueObjects/NoticiaFechaEmision.php',
        'NoticiaDescripcion' => 'Domain/ValueObjects/NoticiaDescripcion.php',
        'NoticiaModel' => 'Domain/Models/NoticiaModel.php',

        // Application - Puertos In/Out Usuarios
        'CreateUserUseCase' => 'Application/Ports/In/CreateUserUseCase.php',
        'UpdateUserUseCase' => 'Application/Ports/In/UpdateUserUseCase.php',
        'GetUserByIdUseCase' => 'Application/Ports/In/GetUserByIdUseCase.php',
        'GetAllUsersUseCase' => 'Application/Ports/In/GetAllUsersUseCase.php',
        'DeleteUserUseCase' => 'Application/Ports/In/DeleteUserUseCase.php',
        'LoginUseCase' => 'Application/Ports/In/LoginUseCase.php',

        'SaveUserPort' => 'Application/Ports/Out/SaveUserPort.php',
        'UpdateUserPort' => 'Application/Ports/Out/UpdateUserPort.php',
        'GetUserByIdPort' => 'Application/Ports/Out/GetUserByIdPort.php',
        'GetUserByEmailPort' => 'Application/Ports/Out/GetUserByEmailPort.php',
        'GetAllUsersPort' => 'Application/Ports/Out/GetAllUsersPort.php',
        'DeleteUserPort' => 'Application/Ports/Out/DeleteUserPort.php',

        // Application - Puertos In/Out Noticias (Ejercicio 29)
        'CreateNoticiaUseCase' => 'Application/Ports/In/CreateNoticiaUseCase.php',
        'UpdateNoticiaUseCase' => 'Application/Ports/In/UpdateNoticiaUseCase.php',
        'GetNoticiaByIdUseCase' => 'Application/Ports/In/GetNoticiaByIdUseCase.php',
        'GetAllNoticiasUseCase' => 'Application/Ports/In/GetAllNoticiasUseCase.php',
        'DeleteNoticiaUseCase' => 'Application/Ports/In/DeleteNoticiaUseCase.php',

        'SaveNoticiaPort' => 'Application/Ports/Out/SaveNoticiaPort.php',
        'UpdateNoticiaPort' => 'Application/Ports/Out/UpdateNoticiaPort.php',
        'GetNoticiaByIdPort' => 'Application/Ports/Out/GetNoticiaByIdPort.php',
        'GetAllNoticiasPort' => 'Application/Ports/Out/GetAllNoticiasPort.php',
        'DeleteNoticiaPort' => 'Application/Ports/Out/DeleteNoticiaPort.php',

        // Application - DTOs y Servicios Usuarios
        'CreateUserCommand' => 'Application/Services/Dto/Commands/CreateUserCommand.php',
        'UpdateUserCommand' => 'Application/Services/Dto/Commands/UpdateUserCommand.php',
        'DeleteUserCommand' => 'Application/Services/Dto/Commands/DeleteUserCommand.php',
        'LoginCommand' => 'Application/Services/Dto/Commands/LoginCommand.php',
        'GetUserByIdQuery' => 'Application/Services/Dto/Queries/GetUserByIdQuery.php',
        'GetAllUsersQuery' => 'Application/Services/Dto/Queries/GetAllUsersQuery.php',

        'CreateUserService' => 'Application/Services/CreateUserService.php',
        'UpdateUserService' => 'Application/Services/UpdateUserService.php',
        'GetUserByIdService' => 'Application/Services/GetUserByIdService.php',
        'GetAllUsersService' => 'Application/Services/GetAllUsersService.php',
        'DeleteUserService' => 'Application/Services/DeleteUserService.php',
        'LoginService' => 'Application/Services/LoginService.php',
        'UserApplicationMapper' => 'Application/Services/Mappers/UserApplicationMapper.php',

        // Application - DTOs y Servicios Noticias (Ejercicio 29)
        'CreateNoticiaCommand' => 'Application/Services/Dto/Commands/CreateNoticiaCommand.php',
        'UpdateNoticiaCommand' => 'Application/Services/Dto/Commands/UpdateNoticiaCommand.php',
        'DeleteNoticiaCommand' => 'Application/Services/Dto/Commands/DeleteNoticiaCommand.php',
        'GetNoticiaByIdQuery' => 'Application/Services/Dto/Queries/GetNoticiaByIdQuery.php',
        'GetAllNoticiasQuery' => 'Application/Services/Dto/Queries/GetAllNoticiasQuery.php',

        'NoticiaApplicationMapper' => 'Application/Services/Mappers/NoticiaApplicationMapper.php',
        'CreateNoticiaService' => 'Application/Services/CreateNoticiaService.php',
        'UpdateNoticiaService' => 'Application/Services/UpdateNoticiaService.php',
        'GetNoticiaByIdService' => 'Application/Services/GetNoticiaByIdService.php',
        'GetAllNoticiasService' => 'Application/Services/GetAllNoticiasService.php',
        'DeleteNoticiaService' => 'Application/Services/DeleteNoticiaService.php',

        // Infrastructure - Persistencia MySQL Usuarios
        'Connection' => 'Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php',
        'UserPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php',
        'UserEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php',
        'UserPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php',
        'UserRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php',

        // Infrastructure - Persistencia MySQL Noticias (Ejercicio 29)
        'NoticiaPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/NoticiaPersistenceDto.php',
        'NoticiaEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/NoticiaEntity.php',
        'NoticiaPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/NoticiaPersistenceMapper.php',
        'NoticiaRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/NoticiaRepositoryMySQL.php',

        // Infrastructure - Entrypoints Web Usuarios
        'CreateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateUserRequest.php',
        'UpdateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateUserRequest.php',
        'LoginWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/LoginWebRequest.php',
        'UserResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UserResponse.php',
        'UserWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/UserWebMapper.php',
        'UserController' => 'Infrastructure/Entrypoints/Web/Controllers/UserController.php',
        'WebRoutes' => 'Infrastructure/Entrypoints/Web/Controllers/Config/WebRoutes.php',

        // Infrastructure - Entrypoints Web Noticias (Ejercicio 29)
        'CreateNoticiaWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateNoticiaRequest.php',
        'UpdateNoticiaWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateNoticiaRequest.php',
        'NoticiaResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/NoticiaResponse.php',
        'NoticiaWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/NoticiaWebMapper.php',
        'NoticiaController' => 'Infrastructure/Entrypoints/Web/Controllers/NoticiaController.php',

        // Presentación y DI
        'View' => 'Infrastructure/Entrypoints/Web/Presentation/View.php',
        'Flash' => 'Infrastructure/Entrypoints/Web/Presentation/Flash.php',
        'DependencyInjection' => 'Common/DependencyInjection.php',
    );

    public static function register(): void
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass(string $className): void
    {
        if (!isset(self::$classMap[$className])) {
            return;
        }

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        $filePath = $baseDir . self::$classMap[$className];

        if (!file_exists($filePath)) {
            throw new RuntimeException(
                sprintf('No se encontró el archivo para la clase %s en %s', $className, $filePath)
            );
        }

        require_once $filePath;
    }
}