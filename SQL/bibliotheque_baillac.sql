PGDMP  #                    |            bibliotheque_baillac    17.2    17.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false                       1262    20112    bibliotheque_baillac    DATABASE     �   CREATE DATABASE bibliotheque_baillac WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'French_France.1252';
 $   DROP DATABASE bibliotheque_baillac;
                     postgres    false                       0    0    DATABASE bibliotheque_baillac    ACL     |   GRANT ALL ON DATABASE bibliotheque_baillac TO collaborateur1;
GRANT ALL ON DATABASE bibliotheque_baillac TO collaborateur2;
                        postgres    false    4870            �            1259    20163    historique_transactions    TABLE       CREATE TABLE public.historique_transactions (
    id_transaction integer NOT NULL,
    id_adherent bigint NOT NULL,
    id_employe integer NOT NULL,
    date_emprunt date NOT NULL,
    date_retour date,
    commentaire text,
    isbn character varying(20),
    id_exemplaire character varying(10) NOT NULL,
    statut character varying(20),
    CONSTRAINT historique_transactions_statut_check CHECK (((statut)::text = ANY ((ARRAY['emprunté'::character varying, 'retourné'::character varying, 'en transit'::character varying])::text[])))
);
 +   DROP TABLE public.historique_transactions;
       public         heap r       postgres    false            �            1259    20162 *   historique_transactions_id_transaction_seq    SEQUENCE     �   CREATE SEQUENCE public.historique_transactions_id_transaction_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 A   DROP SEQUENCE public.historique_transactions_id_transaction_seq;
       public               postgres    false    225                       0    0 *   historique_transactions_id_transaction_seq    SEQUENCE OWNED BY     y   ALTER SEQUENCE public.historique_transactions_id_transaction_seq OWNED BY public.historique_transactions.id_transaction;
          public               postgres    false    224            i           2604    20166 &   historique_transactions id_transaction    DEFAULT     �   ALTER TABLE ONLY public.historique_transactions ALTER COLUMN id_transaction SET DEFAULT nextval('public.historique_transactions_id_transaction_seq'::regclass);
 U   ALTER TABLE public.historique_transactions ALTER COLUMN id_transaction DROP DEFAULT;
       public               postgres    false    225    224    225                       0    20163    historique_transactions 
   TABLE DATA           �   COPY public.historique_transactions (id_transaction, id_adherent, id_employe, date_emprunt, date_retour, commentaire, isbn, id_exemplaire, statut) FROM stdin;
    public               postgres    false    225   �       	           0    0 *   historique_transactions_id_transaction_seq    SEQUENCE SET     Y   SELECT pg_catalog.setval('public.historique_transactions_id_transaction_seq', 90, true);
          public               postgres    false    224            l           2606    20170 4   historique_transactions historique_transactions_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public.historique_transactions
    ADD CONSTRAINT historique_transactions_pkey PRIMARY KEY (id_transaction);
 ^   ALTER TABLE ONLY public.historique_transactions DROP CONSTRAINT historique_transactions_pkey;
       public                 postgres    false    225            m           2606    20181 ?   historique_transactions historique_transactions_id_employe_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historique_transactions
    ADD CONSTRAINT historique_transactions_id_employe_fkey FOREIGN KEY (id_employe) REFERENCES public.employes(id_employe);
 i   ALTER TABLE ONLY public.historique_transactions DROP CONSTRAINT historique_transactions_id_employe_fkey;
       public               postgres    false    225                �  x��ZˎG<���o�HFe���w�ؓ��fz�rH��������?�#���Vv���ЀP�#++3"2[�qѦ�v::݄F+m?}P��Q���zu��m���>=u����}�^}�_=��պ��I!ƨT0�G�~��k~����2���ZE�`}��?h��c�iOχ�0�$�D��DFy�i��{�>�������C{�U�߷���~�>n���ۧn�G����u���<d<j�KQ%����ס���~�ۭC���]{���j��~����]���{x��=�B��j�:��s!�RD�,7�N�����Pn���I쎛�xݷw�͡��~h�����r�K��qƐe���(O�.Z|c/X�a��������}<���$������G4��]���w��3O��ɘV��+��o�c�V��D��0e@'�ʗܖ�����◷DHj����G���uInPܥ5���x��t�bAي�/!��F��RX��/���i�s�y��t���}>y������7��n3�PP�S�c̨ �5�.�s�`��srı��$,Û�!���� ��ǳ������Qv�VfL��|�n�s|�#��}n���}ܭ�?���'���\�݅;L��Iѫ�Qn��t��@?$�����g��,#�uja	�U5L�I�"�µ#����o����	$p��x��+J�� W��Gk�R=�_̰���`���&�%��W��h�EP>�����ɠ�f��]%:�Q}I�.�gޒ�f��*;6�ͰhC�ո��R֔���-�K�y�(�E�K5�/+�t�Y$U��b�Φ��h�$el�����.�����+(3-����Ln��a����2�����k{ܴ������]m�O��O��%�?�5��@[�Mf���H_��z��+�T�+�NiPNYkbi���)�H+[S`f2�&N<�`�<�e��Фi��X'��X)�H��;�c��� �����.{K�w��9ItN)$�ܢ|3���c�ۿ�y���>}Z����0��� g�8�����^g-�@1]*֒0`�딏F]��>�ɕ+�Z[�>�$k�mԈ�)j8樆o�m��*:Ǽ���0ťI$N<+Ӗu�YER�����9���0�B�C�1`{��-�䑫�����>����j��R�,=ٹ�(􈵙�����u���b�cSiV
�W�����C:�=L5���)3��g�w6�ą�I7R$K%޿5��k���;ji��i�u�Ls�6ԝ'�l�f���;�<e��W�3���H�c	��g�ԍa�("�0�H��4%����K8�0𳕾G`�u$	��JLIe�ⓝ3
~$�޷���Y�\ZX�����2�8d8���5�D��u��0�6oD<	:��N��^�����y7G���TY�6ܥ{#r�D���b�������ؚ������Gp��9;���
1����֫i������!N�Q���<F���b'׻��2���ߍ����%���R�7v��Fc��ul������)�x�AN3l+6�Y_>�'`8���H��/\�-�|Ș���M�:�3^����Ъ!��yYF�߉7졤|B��>K+��x�/ckM9k���|��Z���D�����f�����`ȴȩ����Oo�)�X�0��d8U�R��bg���N�u�Fg
��:$���l�8fk��DX�%*��+mK�5F�+U�i�?�]'��1t��[B�uapr�b`����8$�o�[��aS�X;��ibCN�bp��ᙹ�\��c�nQC)�>|��&L���⁋��`x��YC_�d]��BC'(�1F�V��9�PU�S���$��C���Ǣ�4�dO^Z��:�XI�3�gRbf;��k��-�tT��W�,��_�����8��3!�S�ˀV���S��,��6�U�S}�� ;l5.ڎ1�MVFs�rqc����ݠ�!�����Ny;i��j	dR�s?|��ݻ?5��U     