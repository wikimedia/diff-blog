<?php // phpcs:ignore Wordpress.Files.InvalidClassFileName

namespace MW\Lib;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * MWOAuthProvider is a base class that sets the parameters and methods
 * needed to interact with a MediaWiki 1.36 OAuth2 Server.
 *
 * It is not designed to be used independently and must be extended
 * by an implementation-specific class that will deal with creating/fetching
 * authenticated user objects.
 */
abstract class MWOAuthProvider extends AbstractProvider {

	use BearerAuthorizationTrait;

	/**
	 * @var string
	 */
	protected $restApiUrl; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.PropertyNotSnakeCase

	/**
	 * Returns a full REST Resource URL
	 *
	 * @param string $endpoint
	 *
	 * @return string
	 */
	public function getRestUrl( string $endpoint ): string {
    // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		return $this->restApiUrl . '/' . $endpoint;
	}

	/**
	 * Returns the base URL for authorizing a client.
	 *
	 * Eg. https://oauth.service.com/authorize
	 *
	 * @return string
	 */
	public function getBaseAuthorizationUrl() {
		return $this->getRestUrl( 'oauth2/authorize' );
	}

	/**
	 * Returns the base URL for requesting an access token.
	 *
	 * Eg. https://oauth.service.com/token
	 *
	 * @param array $params
	 * @return string
	 */
	public function getBaseAccessTokenUrl( array $params ) {
		return $this->getRestUrl( 'oauth2/access_token' );
	}

	/**
	 * Returns the URL for requesting the resource owner's details.
	 *
	 * @param AccessToken $token
	 * @return string
	 */
	public function getResourceOwnerDetailsUrl( AccessToken $token ) {
		return $this->getRestUrl( 'oauth2/resource/profile' );
	}

	/**
	 * Returns the default scopes used by this provider.
	 *
	 * This should only be the scopes that are required to request the details
	 * of the resource owner, rather than all the available scopes.
	 *
	 * @return array
	 */
	protected function getDefaultScopes(): array {
		return array();
	}

	/**
	 * Checks a provider response for errors.
	 *
	 * @throws IdentityProviderException
	 * @param  ResponseInterface $response
	 * @param  array|string $data Parsed response data
	 * @return void
	 */
	protected function checkResponse( ResponseInterface $response, $data ): void {
		if ( 200 !== $response->getStatusCode() ) {
			$body = json_decode( $response->getBody(), ARRAY_A );

			$message = $body['hint'];
			throw new IdentityProviderException( $message, $response->getStatusCode(), $response );
		}
	}
}
